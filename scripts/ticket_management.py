import tkinter as tk
from tkinter import messagebox, simpledialog
import requests

BASE_URL = "http://localhost/api"

def fetch_tickets():
    try:
        response = requests.get(f"{BASE_URL}/tickets")
        response.raise_for_status()
        return response.json()
    except requests.exceptions.RequestException as e:
        messagebox.showerror("Error", f"Failed to fetch tickets: {e}")
        return []

def show_tickets():
    tickets = fetch_tickets()
    tickets_listbox.delete(0, tk.END)
    for ticket in tickets:
        tickets_listbox.insert(tk.END, f"{ticket['id']} - {ticket['title']} - {ticket['status']}")

def view_ticket():
    try:
        selected_ticket = tickets_listbox.get(tickets_listbox.curselection())
        ticket_id = selected_ticket.split(" - ")[0]
        response = requests.get(f"{BASE_URL}/tickets/{ticket_id}")
        response.raise_for_status()
        ticket = response.json()
        messagebox.showinfo("Ticket Details", f"Title: {ticket['title']}\nMessage: {ticket['message']}\nStatus: {ticket['status']}")
    except IndexError:
        messagebox.showerror("Error", "No ticket selected")
    except requests.exceptions.RequestException as e:
        messagebox.showerror("Error", f"Failed to fetch ticket details: {e}")

def change_ticket_status(status):
    try:
        selected_ticket = tickets_listbox.get(tickets_listbox.curselection())
        ticket_id = selected_ticket.split(" - ")[0]
        response = requests.put(f"{BASE_URL}/tickets/{ticket_id}", json={"status": status})
        response.raise_for_status()
        messagebox.showinfo("Success", "Ticket status updated successfully")
        show_tickets()
    except IndexError:
        messagebox.showerror("Error", "No ticket selected")
    except requests.exceptions.RequestException as e:
        messagebox.showerror("Error", "Failed to update ticket status")

def respond_ticket():
    try:
        selected_ticket = tickets_listbox.get(tickets_listbox.curselection())
        ticket_id = selected_ticket.split(" - ")[0]
        response_message = simpledialog.askstring("Response", "Enter your response:")
        if response_message:
            response = requests.post(f"{BASE_URL}/tickets/{ticket_id}/response", json={"message": response_message})
            response.raise_for_status()
            messagebox.showinfo("Success", "Response sent successfully")
    except IndexError:
        messagebox.showerror("Error", "No ticket selected")
    except requests.exceptions.RequestException as e:
        messagebox.showerror("Error", f"Failed to send response: {e}")

# GUI Setup
root = tk.Tk()
root.title("Ticket Management")

tickets_listbox = tk.Listbox(root, width=50, height=20)
tickets_listbox.pack()

show_button = tk.Button(root, text="Show Tickets", command=show_tickets)
show_button.pack()

view_button = tk.Button(root, text="View Ticket", command=view_ticket)
view_button.pack()

close_button = tk.Button(root, text="Close Ticket", command=lambda: change_ticket_status('closed'))
close_button.pack()

hold_button = tk.Button(root, text="Hold Ticket", command=lambda: change_ticket_status('on hold'))
hold_button.pack()

respond_button = tk.Button(root, text="Respond to Ticket", command=respond_ticket)
respond_button.pack()

root.mainloop()