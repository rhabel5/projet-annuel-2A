import tkinter as tk
from auth import login

class LoginView(tk.Frame):
    def __init__(self, master=None):
        super().__init__(master)
        self.master = master
        self.create_widgets()

    def create_widgets(self):
        tk.Label(self, text="Email:", font=("Arial", 12)).pack(pady=5)
        self.email_entry = tk.Entry(self, font=("Arial", 12))
        self.email_entry.pack(pady=5)

        tk.Label(self, text="Password:", font=("Arial", 12)).pack(pady=5)
        self.password_entry = tk.Entry(self, show="*", font=("Arial", 12))
        self.password_entry.pack(pady=5)

        tk.Button(self, text="Login", command=self.handle_login, font=("Arial", 12), bg="#4CAF50", fg="white").pack(pady=20)

    def handle_login(self):
        email = self.email_entry.get()
        password = self.password_entry.get()
        success, user_id = login(email, password)
        if success:
            self.master.switch_to_ticket_view()