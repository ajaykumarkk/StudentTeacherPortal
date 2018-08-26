from multiprocessing import Process,Lock
from MemManagement import MMU
import os,sys
import random
import Scheduler

def proc1(lock,procname,page_table_limit,runs):
    print("pid:",os.getpid())
    print("ppid:",os.getppid())
    page_requests=[random.randint(0,page_table_limit-1) for i in range(runs)]
    lock.acquire()
    '''content=str(procname)+":"
    fp=open("Process.txt","a")
    for i in page_requests:
        content+=str(i)+","
    content+="\n"
    fp.write(content)'''
    Scheduler.initialize(page_requests)
    lock.release()

if __name__=="__main__":
    fp=open("config-process.txt")
    temp=open("Process.txt","w")
    temp.close()
    fp=fp.read()
    fp=fp.split("\n")
    config=[]
    for i in fp:
        l=[]
        temp=i.split(",")
        for j in temp:
            t=j.split("=")
            l.append(t[1])
        config.append(l)
    lock = Lock()
    for conf in config:
        proc=Process(name=conf[0],target=proc1,args=(lock,conf[0],int(conf[1]),int(conf[2]) ))
        proc.start()
        #proc.join()

    
    Scheduler.initialize()
    Scheduler.schedule()
    


        



