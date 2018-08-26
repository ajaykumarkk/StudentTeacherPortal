import random

class TLB:
    def __init__(self, capacity):
        self.capacity = capacity
        self.tm = 0
        self.cache = {}
        self.lru = {}

    def get(self, key):
        if key in self.cache:
            self.lru[key] = self.tm
            self.tm += 1
            return self.cache[key]
        return -1

    def set(self, key, value):
        if len(self.cache) >= self.capacity:
            # find the LRU entry
            old_key = min(self.lru.keys(), key=lambda k:self.lru[k])
            self.cache.pop(old_key)
            self.lru.pop(old_key)
        self.cache[key] = value
        self.lru[key] = self.tm
        self.tm += 1

    def getlen(self):
        return len(self.cache)

    def flush(self):
        self.cache = {}
        self.lru = {}

class RAM:
    def __init__(self, capacity):
        self.capacity = capacity
        self.tm = 0
        self.cache = {}
        self.lru = {}

    def get(self, key):
        if key in self.cache:
            self.lru[key] = self.tm
            self.tm += 1
            return self.cache[key]
        return -1

    def set(self, key, value):
        if len(self.cache) >= self.capacity:
            # find the LRU entry
            old_key = min(self.lru.keys(), key=lambda k:self.lru[k])
            self.cache.pop(old_key)
            self.lru.pop(old_key)
        self.cache[key] = value
        self.lru[key] = self.tm
        self.tm += 1

    def getlen(self):
        return len(self.cache)

    def flush(self):
        self.cache = {}
        self.lru = {}

class MMU:
    
    page_table=[]
    TLBlimit=4
    TLBobj=TLB(TLBlimit)
    RAMlimit=10
    RAMobj=RAM(RAMlimit)
    TLBhit=0
    TLBmiss=0
    total_mem_access_time=0
    RAM_access_time=200
    TLB_access_time=20
    disk_access_time=800000
    #runs=0
    page_table_limit=0
    page_requests=0

    def search_page(self,virtual_page_num):
        #print(virtual_page_num)
        flag=False
        #search in TLB
        self.total_mem_access_time+=self.TLB_access_time
        if self.TLBobj.get(virtual_page_num)!=-1:
            self.TLBhit+=1
            #print("TLB hit!")
            self.total_mem_access_time+=self.RAM_access_time #access page
        else:
            self.TLBmiss+=1
            self.total_mem_access_time+=self.RAM_access_time #access page table from RAM
            if(self.page_table[virtual_page_num][1]==1): #present bit
                self.total_mem_access_time+=self.RAM_access_time  #access page
                '''update TLB'''
                self.TLBobj.set(virtual_page_num,0)

            else:
                self.total_mem_access_time+=self.disk_access_time
                '''update main memory'''
                if(self.RAMobj.getlen()==self.RAMlimit):
                    flag=True
                    temp=self.RAMobj.set(virtual_page_num,0)
                else:
                    self.RAMobj.set(virtual_page_num,0)
                

                

                '''update TLB'''
                self.TLBobj.set(virtual_page_num,0)

                '''update page table'''
                for i,j in enumerate(self.page_table):
                    if j[0]==virtual_page_num:
                        self.page_table[i][1]=1
                    if flag and j[0]==temp:
                        self.page_table[i][1]=0

    def details(self):
        print("------Details-----")
        print("Total page requests:",self.TLBhit+self.TLBmiss)
        #print("pages accessible:",self.page_table_limit)
        print("Total Memory Access time:",self.total_mem_access_time)
        print("TLB hits:",self.TLBhit)
        print("TLB miss:",self.TLBmiss)
        hitperc=(self.TLBhit/(self.TLBhit+self.TLBmiss))*100
        print("TLB hit percentage:",hitperc)
        print("-------------------")
                    

    def get_page_requests(self,page_requests,page_table_limit):
        self.page_requests=page_requests
        #print("------>",self.page_requests)
        self.page_table_limit=page_table_limit
        #self.runs=runs
        self.page_table=[[i,0]for i in range(page_table_limit)]
        for i in self.page_requests:
            self.search_page(i)


    def flush(self):
        self.TLBobj.flush()
        self.RAMobj.flush()
    



if __name__=="__main__":
    a=MMU()
    page_table_limit=4
    runs=1000
    list1=[random.randint(0,page_table_limit-1) for i in range(runs)]
    #print(list1,page_table_limit)
    a.get_page_requests(list1,page_table_limit)
    a.details()
        



