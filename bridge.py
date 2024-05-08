import joblib
import sys

# Change "model.pkl" sa name sa imong file
model = joblib.load('model.pkl')

# Base on the number of your input(x)
x = [[
        float(sys.argv[1]), 
        float(sys.argv[2]), 
        float(sys.argv[3]), 
        float(sys.argv[4]), 
        float(sys.argv[5]), 
        float(sys.argv[6])
    ]]

# You can adjust this
threshold = 0.2

# For 1 or 0, or True or False outputs
pred = 1 if model.predict(x) > threshold else 0

print(pred)