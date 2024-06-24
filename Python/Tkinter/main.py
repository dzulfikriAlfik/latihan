# GUI

import tkinter as tk
from tkinter import ttk
from tkinter.messagebox import showinfo

window = tk.Tk()

window.configure(bg="whitesmoke")
window.geometry("500x300")
window.resizable(False, False)
window.title("Program Say Hello")

FIRST_NAME = tk.StringVar()
LAST_NAME = tk.StringVar()

# Input frame
input_frame = ttk.Frame(window)
# Penempatan Grid, Pack, Place
input_frame.pack(padx = 10, pady = 10, fill = "x", expand = True)

# Komponen-komponen
# Label Nama depan
first_name_label = ttk.Label(input_frame, text="First Name:")
first_name_label.pack(padx = 10, pady = 3, fill = "x", expand = True)
# Entry Nama depan
first_name_entry = ttk.Entry(input_frame, textvariable=FIRST_NAME)
first_name_entry.pack(padx = 10, pady = 3, fill = "x", expand = True)
# Label Nama belakang
last_name_label = ttk.Label(input_frame, text="Last Name:")
last_name_label.pack(padx = 10, pady = 3, fill = "x", expand = True)
# Entry Nama belakang
last_name_entry = ttk.Entry(input_frame, textvariable=LAST_NAME)
last_name_entry.pack(padx = 10, pady = 3, fill = "x", expand = True)
# Button
def say_hello():
  ''' fungsi ini akan dipanggil oleh tombol '''
  say_hello_message = f"Hello {FIRST_NAME.get()} {LAST_NAME.get()}"
  print(say_hello_message)
  showinfo(title = "Say Hello", message = say_hello_message)

hello_button = ttk.Button(input_frame, text = "Say Hello", command = say_hello)
hello_button.pack(expand = False, pady = 10, padx = 10)

window.mainloop()