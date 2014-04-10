def ReadCSV(filename):
	'''
		read a csv file an return a dictionary in which first element of each row will be key and 
		other elements will be listed as list
	'''
	try:
		f = open(filename, 'r')
	except :
		print "File not found"
		return None
	lines = f.read()
	f.close()
	
	lines = lines.split('\n')
	lines.pop()
	l = {}
	for line in lines:
		t = line.split(',')
		t2=[]
		for n in t[1:]:
			t2.append(float(n))
		l[int(t[0])]= t2
	
	return l
		
