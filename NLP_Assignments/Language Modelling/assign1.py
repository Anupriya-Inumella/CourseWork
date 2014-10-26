import re
import sys
f=open("corpus[5k].en.txt",'r')
f2=open("corpus[1k].en.txt",'r')
f3=open("corpus[1k].en.txt",'r')
f4=open("corpus[1k].en.txt",'r')
unigram_count={}
unigram_prob={}
tokens=0
types=0 #distinct words
bigrams={}
bigram_count={}
bigram_prob={}
for line in f.readlines():
     words=line.split()
     tokens+=len(words)
     for word in words:
         if word not in unigram_count.keys():
             types+=1;
	     unigram_count[word]=1;
         else:
             unigram_count[word]+=1;
     
     for i in range(0,len(words)-1):
	 bigrams[words[i]+" "+words[i+1] ]=[ words[i],words[i+1] ];
     
     
for word in bigrams:
	 if word not in bigram_count.keys():
	     types+=1;
	     bigram_count[word]=1;
	 else:
	     bigram_count[word]+=1;
for key in bigram_count:
	bigram_prob[key]=float(bigram_count[key])/float(tokens);
for key in unigram_count:
	unigram_prob[key]=float(unigram_count[key])/float(tokens);

print "*************************************************************************************"
print "Words:","Count:","Uni/Bi count:","Uni/Bi prob";
print "*************************************************************************************"
for key in unigram_count:
	print  "unigram",key," ",unigram_count[key]," ",unigram_prob[key]," ",unigram_prob[key]*100;
	print "\n"

print"\n"
for key in bigrams:
	print "bigram",key," ",bigram_count[key]," ",bigram_prob[key]," ",bigram_prob[key]*100;
	print"\n"
uni_p_s=1;
bi_p_s=1;
bi=[]
print "\n\nProbabilities of sentences using unigram and bigram prob's"
print "***************************************************************"
for i in range(0,4):
	for line in f2.readlines():
		#print line
		words=line.split();
		for word in words:
			if word not in unigram_prob:
				uni_p_s*=0
			else:
				uni_p_s*=unigram_prob[word];
		for i in range(0,len(words)-1 ):
			bi.append(words[i]+" "+words[i+1]);		
		for word in bi:
			if(word in bigram_prob):
				bi_p_s*=bigram_prob[word];
			else:
				bi_p_s*=0
		print line,
		print "P(s)-unigram",uni_p_s,
		print "P(s)-bigram",bi_p_s;
 
print "\n\n"
count=0	
for line in f3.readlines():		
	if(count<5):
		words=line.split();
		#print words,"--------"
		maximum=0;
		sen=[]
		#x=words[2]
		if(len(words)>2):
			x=words[2];
			for j in range(2,9):
				#print "i m h"
				for key in bigrams:
					if bigrams[key][0]==x:
						if bigram_prob[key] > maximum:
							maximum=bigram_prob[key];
							x=bigrams[key][1];
				sen.append(x);
			for g in range(0,len(sen)-1):
				print sen[g],
			print "\n"
	count=count+1
big=[]
for line in f4.readlines():
	words=line.split();
	for i in range(0,len(words)-1 ):
                        big.append(words[i]+" "+words[i+1]);
                	for word in big:
				if word not in bigram_count:#for a bi-gram which doesn't exist i.e., count=0
					for k in big:
						#print word,
						bigram_count[word]=1;
						bigram_prob[word]=float(bigram_count[word])/float(len(words)-1);
				else:#if it exists then add +1 to al bi-gram counts
					bigram_count[word]+=1;
					bigram_prob[word]=float(bigram_count[word])/float(len(words)-1);









