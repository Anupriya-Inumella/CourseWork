class TrieNode:
        def __init__(self, prefix=""): 
                self.children = {}
                self.count = 0;
                self.prefix = prefix;
        
        
        def insert(self, word, prefix):
                if len(word):
                        if not self.children.has_key(word[0]):
                                self.children[word[0]] = TrieNode();
                        if self.prefix == "":
                                self.prefix += prefix;
                        if len(word) == 1: 
                                self.count += 1
                                print self.count
                        self.children[word[0]].insert(word[1:], self.prefix + word[0]);
                        
                
        def remove(self, word):
                if self.counts(word) == 1: 
                        self.permanantRemove(word);
                else: 
                        self.counts(word, update = True);
 
        def permanantRemove(self, word):
                if len(word) and self.children.has_key(word[0]): 
                        self.children[word[0]].remove(word[1:]);
                        if not self.count: 
                                del self.children[word[0]]
 
        def counts(self, word, update = False):
                if len(word) == 1 and word=="$":
                        if update: 
                                self.count -= 1;
                        return self.count
                if len(word) and self.children.has_key(word[0]):
                        return self.children[word[0]].counts(word[1:], update)
                        
        def prints(self, sep):
                if len(self.children.keys()) == 0:
			print 'root'
		else:
			if self.children.has_key("$"):
                        	print sep + " $"
                	for (key, value) in sorted(self.children.items()):
                        	if key == "$": continue;
                        	print sep + " "+key + str('')
                        	value.prints(sep + " |");
        def printWords(self):
                for (key, value) in sorted(self.children.items()):
                        if key == "$": print self.prefix + " " + str(self.count),
                        value.printWords();
                        
                return '';
 
 
        def search(self, word):
                if len(word)>1 and self.children.has_key(word[0]):
                        return self.children[word[0]].search(word[1:])
                elif len(word)==1 and self.children.has_key(word[0]):
                        print "true", self.children[word[0]].count,
                else:
                        print 'false',
                        print self.printWords()
			#print '\n'
                        return -1;
		print '\n'
                        
root = TrieNode()
t=raw_input()
for i in range(0,int(t)):
        a= raw_input(); 
        a = a.strip();
        if a=='ptrie':
                root.prints("|")
                continue
        (instruction, value) = a.split();
        value += "$"

	value=value.lower() 

        if instruction == "insert":
                root.insert(value, "");
        elif instruction == "remove":
                cnt = root.counts(value);
                if cnt > 0: print cnt - 1
                else:
                        print -1
                root.remove(value);
        elif instruction == "search":
                root.search(value);
        elif instruction == "prints":
                root.prints("|");
        elif value == " ":
                root.prints("|");
