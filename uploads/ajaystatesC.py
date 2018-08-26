# '''
# e -> e + t 
# e -> t
# t -> t * f 
# t -> f 
# f -> id(ID)
#'''

#Case 1
l1 = ['S^','S', 'S', 'S', 'S', 'A']
l2 = ['S','Aa', 'bAc','dc','bda', 'd']
#l1 = ['S^','S', 'S', 'S', 'S', 'A']
#l2 = ['S','Aa', 'bAc','dc','bda', 'd']

#Case 2
#l1 = ['S^','S','S','A','B']
#l2 = ['S','AaAb','BbBa','','']

#Case 3
#l1 = ['s^','s','A','A','B','B']
#l2 = ['s','A','AB','','aB','b']
#case 4
#l1=['s^','s','s','s']
#l2=['s','ss+','ss*','a']
import re

def first_compute(prod,look_ahead):
	if not re.match(r"[A-Z]",prod[0]):
		return {prod[0]}
	if len(prod)==1 and '!' in first_list[prod]:
		return (first_list[prod].difference('!')).union(look_ahead)
	a=first_list[prod[0]]
	if '!' in a:
		a=a.union(first_compute(prod[1:],look_ahead))
	return a.difference('!')

def first(prod,look_ahead):
	if prod=='':
		return look_ahead
	return first_compute(prod,look_ahead)
	
def look_ahead():
	for index,production in enumerate(productions):
		for non_terminal in re.finditer(r"[A-Z]",production):
			prod_remaining=production[non_terminal.span()[0]+1:len(production)]
			look_ahead_dict[non_terminal.group()]=look_ahead_dict[non_terminal.group()].union(first(prod_remaining,look_ahead_dict[head[index]]))
'''
look_ahead_dict={'S^':{'$'},'S':set(),'A':set(),'B':set()}
productions=l2
#head=['S^','S','S','S']
head=l1
first_list={'S':{'a','b'},'A':set(),'B':set()}
look_ahead()
print(look_ahead_dict)'''
look_ahead_dict={'S^':{'$'},'S':set(),'A':set()}
productions=l2
#head=['S|','S','S','S']
head=l1
first_list={'S':{'a','b'},'A':set()}
look_ahead()
print(look_ahead_dict)


def f(x):
	global s
	s.append(x)
	if x[1]>=len(l2[x[0]]):
		return
	t=l2[x[0]][x[1]] #refers to the character pointed by the dot eg :s->s+.a  t refers to a
	for i, j in enumerate(l1):
		if(j == t and (i,0) not in s): #if the head of the productin is same as t(char after dot) add that production  ....appended in then next call of the function.. add only if the new production is absent -> only if ( i,0) not in s
			f((i,0))



def f1(B):
        global s
        global T
        t=[]
        t1=[]
        t2=[]
        t3=[]
        temp=[]
        for i in B:
                t.append(i[0])#production no.
                t1.append(i[1])#position of dot
        #print(t)
        flag=0
        s=[]
        i=0
        tempDict={}
#        print(B)
        for i in t:
                j=t1[t.index(i)]
                
                if j < (len(l2[i])):
      #                  print(l2[i],i)
     #                   print("j:",j)
                        
                        temp=l2[i][j]#storing the consumed symbol(upon which varaible the transisiton in taken place)
                      # T.append(temp)
                        #print(temp)
                        
                        if temp in t2: #and u add them to the list t2
                                flag=1
                        else:
                                t2.append(temp)
             #           print(t2)
                        j+=1
                        if flag == 1:
                                ind=t2.index(temp)#now getting the positon to merge the generated production based upon the value stored in the temp which is same as the positon in t2 because for every production variable consumed we add one in t2
                                f((i,(j)))
                               # print(s)
                                
                                flag==0
                        else:
                                #print(i,'--',j)
                                f((i,(j)))
               #                
    #                            print(s)
                        if temp not in tempDict:
                                tempDict[temp]=[] # u check if the transition upon that variable is done already if its done set the flag this code is used for merging
                        if s[0] not in tempDict[temp]:
                                tempDict[temp].extend(s)# u merge with the state
                s=[]
            #    print(T,'--')
        T.append(list(tempDict.keys()))
       
        for i in tempDict:
                #if(tempDict[i] not in L): 
                L.append(tempDict[i])
       # print(s)       
        

s=list()
L=list()
T=list()
f((0,0))
s.sort()
L.append(s)
k=0
while(True):
   if(k<len(L)):
          # print("lk",L[k])
           f1(L[k])
   else:
           break
   #print(L)
   k+=1
for i in L:
        pass
T1=list()
print("the first state is",L[0])
for i in T[0:]:
        if i != []:
          T1.extend(i)      
#print(T1)

for i in range(0,len(T1)):
        print("Transition Upon",T1[i],'And the States are',L[i+1])

print('All the states are')
for i in L:
        print(i)
