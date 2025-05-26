import sys
import joblib
import numpy as np
import os
import warnings

warnings.filterwarnings("ignore")

# Parsing argumen dari Laravel
try:
    usia, tekstur, kalori, protein, lemak, karbohidrat = sys.argv[1:]
    usia = float(usia)
    kalori = float(kalori)
    protein = float(protein)
    lemak = float(lemak)
    karbohidrat = float(karbohidrat)
except:
    print("Invalid input")
    sys.exit(1)

# Load model dan preprocessing tools
BASE_PATH = "storage/app"

model = joblib.load(os.path.join(BASE_PATH, 'model_mpasi.pkl'))
le_tekstur = joblib.load(os.path.join(BASE_PATH, 'le_tekstur.pkl'))
le_kelas = joblib.load(os.path.join(BASE_PATH, 'le_kelas.pkl'))
scaler = joblib.load(os.path.join(BASE_PATH, 'scaler.pkl'))

# Encode tekstur
try:
    tekstur_encoded = le_tekstur.transform([tekstur])[0]
except:
    print("Invalid tekstur input")
    sys.exit(1)

# Buat dan transform fitur
features = np.array([[usia, tekstur_encoded, kalori, protein, lemak, karbohidrat]], dtype=float)
features_scaled = scaler.transform(features)

# Prediksi
predicted_class = model.predict(features_scaled)
label = le_kelas.inverse_transform(predicted_class)

print(label[0])
