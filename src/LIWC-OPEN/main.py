#!/usr/bin/python

import sys, getopt
import nltk
import re

features={}

def token_count_and_dictionary_words(text):
	text=re.sub("\?|[^a-zA-Z ]", " ", text)
	words=re.findall(r"[\w']+",text.lower())
	
	dicwords=0
	for word in words:
		if nltk.corpus.wordnet.synsets(word):
			dicwords+=1
	
	return len(words),dicwords
	
def word_per_sentence(text,wc):
	sent_detector = nltk.data.load('tokenizers/punkt/english.pickle')
	#sentence=re.split('.|?',text)
	#print sentence
	print sent_detector.tokenize(text.strip())
	sc=len(sent_detector.tokenize(text.strip()))
	return float(wc/sc)

def main(argv):
	fname = ''
	try:
		opts, args = getopt.getopt(argv,"hi:o:",["fname"])
	except getopt.GetoptError:
		print 'main.py <fname>'
		sys.exit(2)
	
	fname=args[0]
	try:
		f=open(fname)
	except:
		print "File does not exist"
		sys.exit(1)
	text=f.read()
	f.close()
	features["wc"],features["dic"]=token_count_and_dictionary_words(text)
	features["wps"]=word_per_sentence(text,features["wc"])
	
	
	print features
	
	

if __name__ == "__main__":
   main(sys.argv[1:])
