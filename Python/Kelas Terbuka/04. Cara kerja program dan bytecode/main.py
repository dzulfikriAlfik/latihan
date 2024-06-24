import time

start_time = time.time()

for i in range(1, 1_000_000):
  a = 10 * 1 + (i * 8)

end_time = time.time() - start_time

print(f"Program run for {end_time} seconds")

# Jalankan -> python -m py_compile main.py
# Akan terbuat generated file yang sudah tercompile di folder __pycache__
# Jalankan -> python __pycache__ ******.pyc