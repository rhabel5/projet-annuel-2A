import tkinter as tk
from views.login_view import LoginView
from views.ticket_view import TicketView
from utils.svg_loader import load_svg
from utils.plugin_manager import load_plugins

def main():
    root = tk.Tk()
    root.title("Ticket Management System")
    root.geometry("600x600")
    root.config(bg="#f0f0f0")

    app = App(root)
    app.pack(expand=True, fill="both")

    root.mainloop()

class App(tk.Frame):
    def __init__(self, master=None):
        super().__init__(master)
        self.master = master
        self.login_view = LoginView(self)
        self.login_view.pack(expand=True, fill="both")

    def switch_to_ticket_view(self):
        self.login_view.pack_forget()
        self.ticket_view = TicketView(self)
        self.ticket_view.pack(expand=True, fill="both")
        load_plugins()

if __name__ == "__main__":
    main()