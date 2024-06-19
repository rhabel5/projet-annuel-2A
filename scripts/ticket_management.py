import tkinter as tk
from tkinter import messagebox, simpledialog, ttk
import requests

BASE_URL = "http://localhost/api"
token = None
user_id = None

def login():
    global token, user_id
    email = email_entry.get()
    password = password_entry.get()
    try:
        response = requests.post(f"{BASE_URL}/login", json={"email": email, "password": password})
        response.raise_for_status()
        data = response.json()
        token = data.get("token")
        headers = {"Authorization": f"Bearer {token}"}
        user_response = requests.get(f"{BASE_URL}/user", headers=headers)
        user_response.raise_for_status()
        user_data = user_response.json()
        user_id = user_data["id"]
        if any(role['name'] == 'admin' for role in user_data["roles"]):
            messagebox.showinfo("Success", "Login successful.")
            show_ticket_management()
        else:
            messagebox.showerror("Error", "Vous n'avez pas les droits")
    except requests.exceptions.RequestException as e:
        messagebox.showerror("Error", f"Failed to login: {e}")

def fetch_tickets():
    try:
        headers = {"Authorization": f"Bearer {token}"}
        response = requests.get(f"{BASE_URL}/tickets", headers=headers)
        response.raise_for_status()
        return response.json()
    except requests.exceptions.RequestException as e:
        messagebox.showerror("Error", f"Failed to fetch tickets: {e}")
        return []

def filter_tickets(tickets, filter_type):
    if filter_type == "all":
        return tickets
    elif filter_type == "assigned_to_me":
        return [ticket for ticket in tickets if ticket['assigned_to'] == user_id]
    else:
        return [ticket for ticket in tickets if ticket['status'] == filter_type]

def show_tickets():
    tickets = fetch_tickets()
    filter_type = filter_combobox.get()
    filtered_tickets = filter_tickets(tickets, filter_type)
    tickets_listbox.delete(0, tk.END)
    for ticket in filtered_tickets:
        assigned_to = ticket['assigned_to'] if ticket['assigned_to'] else 'Unassigned'
        ticket_text = f"{ticket['id']} - {ticket['title']} - {ticket['status']} - {ticket['user']['email']} - {assigned_to}"
        tickets_listbox.insert(tk.END, ticket_text)
        if ticket['status'] == 'closed':
            tickets_listbox.itemconfig(tk.END, {'bg': 'red'})
        elif ticket['status'] == 'on hold':
            tickets_listbox.itemconfig(tk.END, {'bg': 'orange'})
        elif ticket['status'] == 'resolved':
            tickets_listbox.itemconfig(tk.END, {'bg': 'blue'})
        else:
            tickets_listbox.itemconfig(tk.END, {'bg': 'green'})

def view_ticket():
    try:
        selected_ticket = tickets_listbox.get(tickets_listbox.curselection())
        ticket_id = selected_ticket.split(" - ")[0]
        headers = {"Authorization": f"Bearer {token}"}
        response = requests.get(f"{BASE_URL}/tickets/{ticket_id}", headers=headers)
        response.raise_for_status()
        ticket = response.json()
        messagebox.showinfo("Ticket Details", f"Title: {ticket['title']}\nMessage: {ticket['message']}\nStatus: {ticket['status']}\nUser: {ticket['user']['email']}\nAssigned to: {ticket['assigned_to']}")
    except IndexError:
        messagebox.showerror("Error", "No ticket selected")
    except requests.exceptions.RequestException as e:
        messagebox.showerror("Error", f"Failed to fetch ticket details: {e}")

def change_ticket_status(status):
    try:
        selected_ticket = tickets_listbox.get(tickets_listbox.curselection())
        ticket_id = selected_ticket.split(" - ")[0]
        headers = {"Authorization": f"Bearer {token}"}
        response = requests.put(f"{BASE_URL}/tickets/{ticket_id}/status", json={"status": status}, headers=headers)
        response.raise_for_status()
        messagebox.showinfo("Success", "Ticket status updated successfully")
        show_tickets()
    except IndexError:
        messagebox.showerror("Error", "No ticket selected")
    except requests.exceptions.RequestException as e:
        messagebox.showerror("Error", f"Failed to update ticket status: {e}")

def respond_ticket():
    try:
        selected_ticket = tickets_listbox.get(tickets_listbox.curselection())
        ticket_id = selected_ticket.split(" - ")[0]
        response_message = simpledialog.askstring("Response", "Enter your response:")
        if response_message:
            headers = {"Authorization": f"Bearer {token}"}
            response = requests.post(f"{BASE_URL}/tickets/{ticket_id}/response", json={"message": response_message}, headers=headers)
            response.raise_for_status()
            messagebox.showinfo("Success", "Response sent successfully")
    except IndexError:
        messagebox.showerror("Error", "No ticket selected")
    except requests.exceptions.RequestException as e:
        messagebox.showerror("Error", f"Failed to send response: {e}")

def create_ticket():
    try:
        title = simpledialog.askstring("Create Ticket", "Enter the ticket title:")
        message = simpledialog.askstring("Create Ticket", "Enter the ticket message:")
        if title and message:
            headers = {"Authorization": f"Bearer {token}"}
            response = requests.post(f"{BASE_URL}/tickets", json={"title": title, "message": message}, headers=headers)
            response.raise_for_status()
            messagebox.showinfo("Success", "Ticket created successfully")
            show_tickets()
    except requests.exceptions.RequestException as e:
        messagebox.showerror("Error", f"Failed to create ticket: {e}")

def delete_ticket():
    try:
        selected_ticket = tickets_listbox.get(tickets_listbox.curselection())
        ticket_id = selected_ticket.split(" - ")[0]
        headers = {"Authorization": f"Bearer {token}"}
        response = requests.delete(f"{BASE_URL}/tickets/{ticket_id}", headers=headers)
        response.raise_for_status()
        messagebox.showinfo("Success", "Ticket deleted successfully")
        show_tickets()
    except IndexError:
        messagebox.showerror("Error", "No ticket selected")
    except requests.exceptions.RequestException as e:
        messagebox.showerror("Error", f"Failed to delete ticket: {e}")

def assign_ticket():
    try:
        selected_ticket = tickets_listbox.get(tickets_listbox.curselection())
        ticket_id = selected_ticket.split(" - ")[0]
        headers = {"Authorization": f"Bearer {token}"}
        response = requests.put(f"{BASE_URL}/tickets/{ticket_id}/assign", headers=headers)
        response.raise_for_status()
        messagebox.showinfo("Success", "Ticket assigned successfully")
        show_tickets()
    except IndexError:
        messagebox.showerror("Error", "No ticket selected")
    except requests.exceptions.RequestException as e:
        messagebox.showerror("Error", f"Failed to assign ticket: {e}")

def show_ticket_management():
    login_frame.pack_forget()
    ticket_frame.pack(expand=True, fill="both")

def logout():
    global token
    token = None
    messagebox.showinfo("Success", "Logged out successfully")
    ticket_frame.pack_forget()
    login_frame.pack(expand=True, fill="both")

def quit_application():
    root.destroy()

# GUI Setup
root = tk.Tk()
root.title("Ticket Management System")
root.geometry("600x600")
root.config(bg="#f0f0f0")

# Login Frame
login_frame = tk.Frame(root, bg="#f0f0f0")
login_frame.pack(expand=True, fill="both")

tk.Label(login_frame, text="Email:", font=("Arial", 12), bg="#f0f0f0").pack(pady=5)
email_entry = tk.Entry(login_frame, font=("Arial", 12))
email_entry.pack(pady=5)

tk.Label(login_frame, text="Password:", font=("Arial", 12), bg="#f0f0f0").pack(pady=5)
password_entry = tk.Entry(login_frame, show="*", font=("Arial", 12))
password_entry.pack(pady=5)

tk.Button(login_frame, text="Login", command=login, font=("Arial", 12), bg="#4CAF50", fg="white").pack(pady=20)

# Ticket Management Frame
ticket_frame = tk.Frame(root, bg="#f0f0f0")

header_frame = tk.Frame(ticket_frame, bg="#4CAF50", pady=10)
header_frame.pack(fill="x")

header_label = tk.Label(header_frame, text="Ticket Management System", bg="#4CAF50", fg="white", font=("Arial", 16, "bold"))
header_label.pack()

content_frame = tk.Frame(ticket_frame, bg="#f0f0f0", pady=20, padx=20)
content_frame.pack(expand=True, fill="both")

tickets_listbox = tk.Listbox(content_frame, width=50, height=20, font=("Arial", 12))
tickets_listbox.pack(pady=10)

filter_frame = tk.Frame(content_frame, bg="#f0f0f0")
filter_frame.pack(pady=5)

filter_label = tk.Label(filter_frame, text="Filter:", font=("Arial", 12), bg="#f0f0f0")
filter_label.pack(side=tk.LEFT, padx=5)

filter_combobox = ttk.Combobox(filter_frame, values=["all", "open", "closed", "on hold", "resolved", "assigned_to_me"], font=("Arial", 12))
filter_combobox.current(0)
filter_combobox.pack(side=tk.LEFT, padx=5)

apply_filter_button = tk.Button(filter_frame, text="Apply Filter", command=show_tickets, font=("Arial", 12), bg="#2196F3", fg="white")
apply_filter_button.pack(side=tk.LEFT, padx=5)

button_frame = tk.Frame(content_frame, bg="#f0f0f0")
button_frame.pack(pady=10)

refresh_button = tk.Button(button_frame, text="Refresh Tickets", command=show_tickets, font=("Arial", 12), bg="#2196F3", fg="white")
refresh_button.grid(row=0, column=0, padx=5, pady=5)

view_button = tk.Button(button_frame, text="View Ticket", command=view_ticket, font=("Arial", 12), bg="#2196F3", fg="white")
view_button.grid(row=0, column=1, padx=5, pady=5)

create_button = tk.Button(button_frame, text="Create Ticket", command=create_ticket, font=("Arial", 12), bg="#4CAF50", fg="white")
create_button.grid(row=0, column=2, padx=5, pady=5)

close_button = tk.Button(button_frame, text="Close Ticket", command=lambda: change_ticket_status('closed'), font=("Arial", 12), bg="#f44336", fg="white")
close_button.grid(row=0, column=3, padx=5, pady=5)

hold_button = tk.Button(button_frame, text="Hold Ticket", command=lambda: change_ticket_status('on hold'), font=("Arial", 12), bg="#FFC107", fg="white")
hold_button.grid(row=0, column=4, padx=5, pady=5)

respond_button = tk.Button(button_frame, text="Respond to Ticket", command=respond_ticket, font=("Arial", 12), bg="#4CAF50", fg="white")
respond_button.grid(row=1, column=0, padx=5, pady=5)

delete_button = tk.Button(button_frame, text="Delete Ticket", command=delete_ticket, font=("Arial", 12), bg="#f44336", fg="white")
delete_button.grid(row=1, column=1, padx=5, pady=5)

assign_button = tk.Button(button_frame, text="Assign Ticket", command=assign_ticket, font=("Arial", 12), bg="#4CAF50", fg="white")
assign_button.grid(row=1, column=2, padx=5, pady=5)

logout_button = tk.Button(button_frame, text="Déconnexion", command=logout, font=("Arial", 12), bg="#FF5722", fg="white")
logout_button.grid(row=1, column=3, padx=5, pady=5)

quit_button = tk.Button(button_frame, text="Quitter", command=quit_application, font=("Arial", 12), bg="#607D8B", fg="white")
quit_button.grid(row=1, column=4, padx=5, pady=5)

root.mainloop()