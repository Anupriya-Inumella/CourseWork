
import re
import os
import sys
from operator import itemgetter

uni_word=[]
uni_count=[]
uni_freq=[]
uni_coverage=[]
bi_word=[]
bi_freq=[]
bi_count=[]
bi_coverage=[]
bi_uni=[]
bi_unword=[]
global d
d={}
global dic
dic={}
list1=[]
d1={}

def unigram():
	global d
	total=0
	for line in f:
		for word in line.split(' '):
			new_word=re.findall('[A-Za-z0-9]+',word)
			new_word=''.join(new_word)
			if new_word:
				if new_word in d:
					d[new_word]=d[new_word]+1
				else:
		 			d[new_word]=1
	for key in d:
		total+=d[key]
	
	for k,v in sorted(d.iteritems(),key=itemgetter(1),reverse=True):
		uni_word.append(k)
		uni_freq.append(v)
		uni_coverage.append(float(v)*100/total)
		uni_count.append(float(v)/total)
	
	print "types=",len(d)
	print "tokens=",total
	print
	
	for i in range(len(uni_word)):
		print "Unigram=",uni_word[i],"Count=",uni_freq[i],"Prob=",uni_count[i],"Coverage=",uni_coverage[i]
	print

def bigram():
	global dic
	count=0
	for line in f:
		for word in line.split(' '):
			biword=[]
			new_word=re.findall('[A-Za-z0-9]+',word)
			new_word=''.join(new_word)
			if(count ==0):
				prev_word=new_word
			else:
				if(new_word):
					biword.append(prev_word)
					biword.append(',')
					biword.append(new_word)
					biword=''.join(biword)
					prev_word=new_word
					if biword:
						if(biword in dic):
							dic[biword]=dic[biword]+1
						else:
							dic[biword]=1
			count+=1
	there=0
	for k,v in sorted(dic.iteritems(),key=itemgetter(1),reverse=True):
		bi_word.append(k)
		bi_freq.append(v)
		bitotal=0
		unigram=0
		h= k.split(',')
		for x,y in dic.iteritems():
			l=x.split(',')
			if h[0]==l[0]:
				unigram+=y
				bitotal+=y
		if h[0]==prev_word:
		 	unigram+=1
		d1[h[0]]=unigram
		for ke,va in dic.iteritems():
			keys=ke.split(',')
			if prev_word in keys[0]:
				there=1
		if there==0:
		 	unigram=1
		 	d1[prev_word]=unigram
		if bitotal:
			bi_coverage.append(float(v)*100/bitotal)
			bi_count.append(float(v)/bitotal)
		else:
			bi_coverage.append('0')
	for g in range(len(bi_word)):
		print "bigram=",bi_word[g],"Count=",bi_freq[g],"Prob=",bi_count[g],"Coverage=",bi_coverage[g]
	print
	for s,t in sorted(d1.iteritems(),key=itemgetter(1),reverse=True):
		bi_uni.append(t)
		bi_unword.append(s)

def newbigram(line):
	count=0
	values=[]
	v_uni=[]
	newbilist=[]
	for word in line.split(' '):
		flag=0
		newbiword=[]
		new_word=re.findall('[A-Za-z0-9]+',word)
		new_word=''.join(new_word)
		if(count ==0):
			if new_word:
				prev_word=new_word
		else:
			if(new_word):
				newbiword.append(prev_word)
				newbiword.append(',')
				newbiword.append(new_word)
				newbiword=''.join(newbiword)
				newbilist.append(newbiword)
#				print "WWWWWW",newbiword
				for k,v in dic.iteritems():
					f=0
					if k==newbiword:
						values.append(v)
						flag=1
#						print "NNNNN",new_word
						for ke,ve in d.iteritems():
							if ke==new_word:
								v_uni.append(ve)
								f=1
						if f!=1:
						 	v_uni.append(0)
				if flag!=1:
					values.append(0)
#					print "NNNNN",new_word
					for ke,ve in d.iteritems():
						if ke==new_word:
							v_uni.append(ve)
							f=1
					if f!=1:
					 	v_uni.append(0)
				prev_word=new_word
		count+=1
#	print "%%%%%%valuessssss%%%%%%",values,v_uni,count,len(values),len(v_uni)
	print "lennn",len(d)
	for hi in range(0,len(values)):
		if values[hi]==0:
			print "bigram  ",newbilist[hi],"  -------> initial bigram probability is 0","      After smoothing ",float(values[hi]+1)/float(v_uni[hi]+len(d)+1)
		else:
			print "bigram  ",newbilist[hi],"  -------> initial bigram probability is ",float(values[hi])/float(v_uni[hi]),"     After smoothing ",float(values[hi]+1)/float(v_uni[hi]+len(d)+1)
			print "Discount  ",(float(values[hi]+1)/float(v_uni[hi]+len(d)+1))/(float(values[hi])/float(v_uni[hi]))

def check():
	for i in range(len(uni_freq)):
#		print uni_word[i],uni_freq[i],"bii",bi_unword[i],bi_uni[i]
		if(uni_freq[i]!=bi_uni[i]):
			return 0

def probability_unigram(array):
	for line in array:
		generate=[]
	  	product=1
		for word in line.split(' '):
			new_word=re.findall('[A-Za-z0-9]+',word)
			new_word=''.join(new_word)
			if new_word:
				generate.append(new_word)
				for t in range(len(uni_word)):
					if new_word==uni_word[t]:
						product*=uni_count[t]
		print ' '.join(generate) ,"----->","unigram prob=",product

def probability_bigram(array):
	count=0
	for line in array:
		generate=[]
	  	product=1
		for word in line.split(' '):
			biword=[]
			new_word=re.findall('[A-Za-z0-9]+',word)
			new_word=''.join(new_word)
			if(count==0):
				generate.append(new_word)
				prev_word=new_word
				for k in range(len(uni_word)):
					if prev_word==uni_word[k]:
						product*=uni_count[k]
			else:
				if(new_word):
				 	generate.append(new_word)
					biword.append(prev_word)
					biword.append(',')
					biword.append(new_word)
					biword=''.join(biword)
					prev_word=new_word
				if biword:
				 	for t in range(len(bi_word)):
						if biword==bi_word[t]:
							product*=bi_count[t]
			count+=1
		print ' '.join(generate),"----->","bigram prob=",product
		print

def construction():
	count=0
	count1=0
	sentences=[]
	l1=[]
	num=0
	f1 = open(sys.argv[2],"rU")
	for line in f1:
		words=[]
		c=0
		c1=0
		if(count1>=5):
			break
		for word in line.split(' '):
			if not word:
				continue
			if(word and c1<3):
				new_word=re.findall('[A-Za-z0-9]+',word)
				word=''.join(new_word)
				if word:
					words.append(word)
					c1+=1
			c+=1
		l1.append(c)
		sentences.append(words)
		count1+=1
	for line in sentences:
	   	answer=[]
		g=0
		flag=0
		wrd = line.pop()
		line.append(wrd)
		while(g<(l1[num]-3)):
			a=maximum(wrd)
			if a:
				wrd=a
				line.append(wrd)
				g+=1
			else:
			 	flag=1
			 	break
		print "NEW LINE CREATED","----->",' '.join(line)
		print
		num+=1
		answer.append(' '.join(line))
		if flag!=1:
			probability_unigram(answer)
			probability_bigram(answer)
		else:
			print "bigram probability is 0"


def maximum(word):
	temp=[]
	a=[]
	new_word=re.findall('[A-Za-z0-9]+',word)
	new_word=''.join(new_word)
	prev_word=new_word
	product=0
	for w1,v in d.iteritems():
		biword=[]
		new_word=w1
		biword.append(prev_word)
		biword.append(',')
		biword.append(new_word)
		biword=''.join(biword)
		if biword:
			 for t in range(len(bi_word)):
				if biword==bi_word[t]:
					prob=bi_count[t]
					if(prob>product):
				 		temp=[]
						product=prob
						temp.append(biword)
					#product=prob
	if temp:
		for m in temp[0].split(','):
			a.append(m)
		return a.pop()
	return
	

filename=sys.argv[1]
f = open(filename,"rU")
unigram()
f.close()
f = open(filename,"rU")
bigram()
ans=check()
if ans is not 0:
	print "Count is SAME"
	print
else:
	print "Count is DIFFERENT"
	print
f.close()
f1 = open(sys.argv[2],"rU")
count=0
sentences=[]
for line in f1:
	if(count>=5):
		break
	sentences.append(line)
	count+=1
probability_unigram(sentences)
f1.close()
f1 = open(sys.argv[2],"rU")
count1=0
sentences=[]
for line in f1:
	if(count1>=5):
		break
	sentences.append(line)
	count1+=1

probability_bigram(sentences)
f1.close()
f1 = open(sys.argv[2],"rU")
construction()
newline=sentences[0]
#newbigram("He also said the fact that the other letter had n't come from Transportation Secretary Samuel Skinner indicated there is `` wiggle room '' in the administration  position .")
newbigram(newline)
f1.close()
