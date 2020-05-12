

#Importing pandas library
import pandas as pd

#Importing numpy library
import numpy as np

#upload dataset
data=pd.read_csv('Heart.csv')

#Importing naive bayes model
from sklearn.naive_bayes import GaussianNB

#load model
NaiveBayes=GaussianNB()

#drop target column
X = data.drop('target',axis=1)

#get target column
y=data.target

#split model into testing and training
from sklearn.model_selection import train_test_split
X_train, X_test, y_train, y_test = train_test_split(X,y,test_size=0.2,random_state = 4)

#apply model
mdl=NaiveBayes.fit(X_train,y_train)

#import joblib to save model
from sklearn.externals import joblib

#save model
joblib.dump(mdl, 'model.pkl')
print("Model dumped!")
