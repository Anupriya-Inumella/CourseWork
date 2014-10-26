class Node():
	def __init__(self,string):
        	self.string=string
        	self.dict={}
	def getString(self):
        	return self.string

	def setNext(self,char,aNode):
	        self.dict[char]=aNode

	def getNext(self,char):
	        if (char in self.dict):
	            return self.dict[char]


class Trie():
	def __init__(self,words):
	        self.startNode=Node("")
		l=[]
		n=len(words)
	        for i in range(0,n):
		    word = words[i]
	            currNode=self.startNode
		    x=len(word)
		    for i in range(0,x):
	                char = word[i]
	                prevNode=currNode
	                if(not prevNode.getNext(char)):
	                    currNode=Node(prevNode.getString()+char)
			    if prevNode.getString()+char not in l:
				l.append(prevNode.getString()+char)
	                    prevNode.setNext(char,currNode)
	                else:
	                    currNode=prevNode.getNext(char)
		print len(l)



t=raw_input()
for i in range(0,int(t)):
	lis=[]	
	l=raw_input()
	s=raw_input()
	for j in range(0,int(l)):
		lis.append(s[j:])
	r=Trie(lis)
		


