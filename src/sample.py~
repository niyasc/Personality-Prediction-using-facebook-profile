import random
from pybrain.tools.shortcuts import buildNetwork
from pybrain.datasets import SupervisedDataSet
from pybrain.structure import TanhLayer
from pybrain.supervised.trainers import BackpropTrainer
import pylab
import sys

sys.path.append('./lib')

from ReadCSV import ReadCSV

test = { 1360550593 : "Shadab", 100001108193506 : "Yawar", 659368463 : "Aashisha", 100006599203697 : "Adil" }

traits = ["extraversion", "agreeableness", "conscientious-", "neuroticism", "openness"]

def main():
	inputs = ReadCSV('./data/input.csv')
	outputs = ReadCSV('./data/output.csv')
	
	test_set = test.keys()
	train_set = []
	for k in inputs.keys():
		if k not in test_set:
			train_set.append(k)
	print "Number of training samples", len(train_set)
	print "Number of testing samples", len(test_set)
			
	net = buildNetwork(178, 6, 5)
	ds=SupervisedDataSet(178,5)
	for id in train_set:
		ds.addSample(inputs[id],outputs[id])

	trainer = BackpropTrainer(net, ds)

	trainer.trainUntilConvergence(maxEpochs=1000, validationProportion = 0.5)
	
	
	for id in test_set:
		predicted = net.activate(inputs[id])
		actual = outputs[id]
		print '-----------------------------'
		print test[id]
		print '-----------------------------'
		print 'Trait\t\tPredicted\tActual\tError'
		for i in range(0,5):
			error = abs(predicted[i] - actual[i])*100/4.0
			print traits[i], '\t', predicted[i], '\t', actual[i], '\t', error,"%" 


if __name__ == "__main__":
	main()
