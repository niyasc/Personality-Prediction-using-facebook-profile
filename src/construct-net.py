from pybrain.tools.shortcuts import buildNetwork
from pybrain.datasets import SupervisedDataSet
from pybrain.structure import TanhLayer
from pybrain.supervised.trainers import BackpropTrainer
import pickle

import sys

sys.path.append('./lib')

from ReadCSV import ReadCSV

class InvalidNumberofTrainingTuples(Exception):
	def __init__(self,message):
		self.message=message
		
		

def make_list(inputs):
	'''
		Make a list corresponding to ids of inputs and return the result
	'''
	ids=[]
	for id in inputs.keys():
		ids.append(id)
	return ids

def constructNet(ids, inputs, outputs):
	'''
		INPUT
		ids	:	A list of ids
		OUTPUT
		net	:	A neural net trained using given ids
	'''
	net = buildNetwork(178, 6, 5, bias = True, hiddenclass = TanhLayer)
	ds=SupervisedDataSet(178,5)
	for id in ids:
		ds.addSample(inputs[id],outputs[id])

	trainer = BackpropTrainer(net, ds)
	'''for t in range(0, 1000):
	trainer.train()'''
	trainer.trainUntilConvergence(maxEpochs=1000)
	
	return net
	
	

	
def main():
	inputs = ReadCSV('./data/input.csv')
	outputs = ReadCSV('./data/output.csv')
	ids = make_list(outputs)
	
	net = constructNet(ids, inputs, outputs)
	
	pickle.dump(net, open('neuralNet.sl', 'w'))



if __name__ == "__main__" :
	main()
