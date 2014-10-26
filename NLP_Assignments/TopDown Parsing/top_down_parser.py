
import sys;
import os;
import re;
f1=open(sys.argv[1],'r');
f2=open(sys.argv[2],'r');
f3=open(sys.argv[1],'r');
rules={}
terminals=[]
word_tags={}
lop=[]
count=[]

for line in f1:
#	print "line",line
	if len(line):
		wo = line.split();
#		print "hello",wo
		if wo[0] not in count:
			count.append(wo[0])
			rules[wo[0]]=[]
	
		
		
#	if rules[wo[0]]:
		m=wo[1:]
			
		x=rules[wo[0]]
		x.append(' '.join(m));
#		print "heyyy",x
#		else:
#			rules[wo[0]]=[]
#			rules[wo[0]].append(wo[i])
#print rules
for line in f3:
	q = line.split()
	for i in range(1,len(q)):
		if q[i] not in terminals and q[i] not in rules.keys():
			terminals.append(q[i]);
			
for line in f2:
	w = line.split();
	word_tags[w[0]] = w[1]
	lop.append(w[0]);
sen =" ".join(lop);
#print word_tags,"word tags";
stk = [];

#sen = "does that flight include a meal";
words = sen.split();
#word_tags = {}
#word_tags = {'does':'aux','that':'det','flight':'n','include':'v','a':'det','meal':'n'}

#rules = { 'S': ['NP VP','aux NP VP','VP'],'NP' : ['det n','properN'],'VP': ['v','v NP'] }
#terminals = ['aux','det','n','v','properN']

e = ['S',sen,rules['S'] ];
#e = ['aux NP VP','does that flight include a meal',rules['S'] ];
stk.append(e);
#print "------------before----------------";
#print stk[-1];
#print stk;
#print " begins here..............";

def pop(stk):
	stk.remove(stk[-1]);
def first(st):
	l = [];
	l = st.split();
	return l[0];
def preterm(st):
	if st in terminals:
		return 1;
	else:
		return 0;
def removefirstrule(string):
	l = []
	l = string.split();
	return l[0];
def copy(lis1,lis2):
	lis1.extend(lis2);
def delete(st):
	l = st.split();
	del l[0];
	st = " ".join(l);
	return st;

while(stk):
	stk1=list(stk)
	
	top_e = stk1[-1];
	if top_e[0]=="" and top_e[1]=="":
		#print stk,"\n";
		print "SUCCESS!"
		break;
	elif sen != "" and top_e[0] == "" :
		pop(stk);
		#print stk,"\n";
	elif sen == ""  and top_e[0] != "":
		pop(stk);
		#print stk,"\n";
	elif preterm(first(top_e[0])):
		#print top_e[0]
		for i in range(len(words)):
			if words[i]==first(top_e[1]):
				break;
		#print "helloo",words[i],first(top_e[0])
		if word_tags[words[i]] == first(top_e[0]):
			newtop_e=list(top_e);
			newtop_e[2] = [];
			newtop_e[0] = delete( newtop_e[0] );
			newtop_e[1] = delete( newtop_e[1] );
			#print "preterm yooo",newtop_e;
			#print "huuh",newtop_e[0]
			if newtop_e[0]:

				if first(newtop_e[0]) not in terminals:
					newtop_e[2]=rules[first(newtop_e[0])];
			else:
				pop(stk)
			stk.append(newtop_e);
			#print "when preterm is encountered";
			#print stk;
			#print "";
			
		else:
			pop(stk);
			#print stk;
	else:
		if top_e[2]:
			h = list(top_e[2]);
			rule_deleted = h[0];
			del h[0];
			top_e[2] = list(h);
			temp = top_e[0];
			temp_list = temp.split();
			del temp_list[0];
			temp = " ".join(temp_list);
		#newtop_e[0] = top_e[2][0];
			newtop_e = list(top_e);
			newtop_e[0] = rule_deleted+" "+temp;
			#print "testtt",newtop_e[0]
		#print newtop_e[0],"******";
			newtop_e[2] = [];
		#print "\n",newtop_e," non terminal ";
		
			if first(newtop_e[0]) not in terminals:
				newtop_e[2]=rules[first(newtop_e[0])];
			
				
			#print "bansss",newtop_e[2]
			stk.append(newtop_e);
		else:
			pop(stk)
		#print "when non terminal is present";
		#print stk;	
		#break;
	for i in range(len(stk)):
		print stk[i]
	print "\n"
	print "\n"


