class IllegalArgumentsException:
	def __init__(self):
		self.error=True

def neural(training_samples=0,inputs=0,sets=[],error=0,a=1):
	if training_samples==0 or inputs==0:
		return None
	#initialize weights
	w={}
	b=0
	for i in range(inputs):
		w[i]=0
		#b[i]=0
	#print w,b
	i=1 
	while True:
		Error=0
		print "Epoch", i
		for s in sets:
			if len(s) != (inputs+1):
				raise IllegalArgumentsException
			iset = s[:inputs];
			t = s[inputs:][0];
			o = 0
			print iset,t
			for j in range(inputs):
				#print j
				o+=w[j]*iset[j]
			o+=b
			Error+=abs(t-o)
			print w,b
			for j in range(inputs):
				w[j]=w[j]+a*(t-o)*iset[j]
			b+=a*(t-o)
		if Error <= error :
			break;
		print Error
		i+=1
	return w,b
neural(4,2,[[0,0,0],[0,1,1],[1,0,1],[1,1,2]])
			
		
