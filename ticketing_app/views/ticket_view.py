import tkinter as tk
from tkinter import messagebox, simpledialog, ttk
from ticket import fetch_tickets, create_ticket, update_ticket_status, delete_ticket, respond_ticket, assign_ticket
from PIL import Image, ImageTk
import cairosvg
import io
import json
import os

def load_svg_as_image(svg_path, width, height):
    png_data = cairosvg.svg2png(url=svg_path, output_width=width, output_height=height)
    image = Image.open(io.BytesIO(png_data))
    return ImageTk.PhotoImage(image)

class TicketView(tk.Frame):
    def __init__(self, master=None):
        super().__init__(master)
        self.create_widgets()

    def create_widgets(self):
        self.tickets_listbox = tk.Listbox(self, width=50, height=20, font=("Arial", 12))
        self.tickets_listbox.pack(pady=10)

        filter_frame = tk.Frame(self, bg="#f0f0f0")
        filter_frame.pack(pady=5)

        tk.Label(filter_frame, text="Filter:", font=("Arial", 12), bg="#f0f0f0").pack(side=tk.LEFT, padx=5)

        self.filter_combobox = ttk.Combobox(filter_frame, values=["all", "open", "closed", "on hold", "resolved", "assigned_to_me"], font=("Arial", 12))
        self.filter_combobox.current(0)
        self.filter_combobox.pack(side=tk.LEFT, padx=5)

        tk.Button(filter_frame, text="Apply Filter", command=self.show_tickets, font=("Arial", 12), bg="#2196F3", fg="white").pack(side=tk.LEFT, padx=5)

        self.button_frame = tk.Frame(self, bg="#f0f0f0")
        self.button_frame.pack(pady=10)

        # Load the SVG images
        assets_path = "./assets/"
        self.refresh_img = load_svg_as_image(os.path.join(assets_path, "refresh.svg"), 30, 30)
        self.view_img = load_svg_as_image(os.path.join(assets_path, "view.svg"), 30, 30)
        self.create_img = load_svg_as_image(os.path.join(assets_path, "create.svg"), 30, 30)
        self.close_img = load_svg_as_image(os.path.join(assets_path, "close.svg"), 30, 30)
        self.hold_img = load_svg_as_image(os.path.join(assets_path, "hold.svg"), 30, 30)
        self.respond_img = load_svg_as_image(os.path.join(assets_path, "respond.svg"), 30, 30)
        self.delete_img = load_svg_as_image(os.path.join(assets_path, "delete.svg"), 30, 30)
        self.assign_img = load_svg_as_image(os.path.join(assets_path, "assign.svg"), 30, 30)

        # Create buttons with images
        tk.Button(self.button_frame, text="Refresh Tickets", image=self.refresh_img, command=self.show_tickets, font=("Arial", 12), bg="#2196F3", fg="white", compound="top").grid(row=0, column=0, padx=5, pady=5)
        tk.Button(self.button_frame, text="View Ticket", image=self.view_img, command=self.view_ticket, font=("Arial", 12), bg="#2196F3", fg="white", compound="top").grid(row=0, column=1, padx=5, pady=5)
        tk.Button(self.button_frame, text="Create Ticket", image=self.create_img, command=self.create_ticket, font=("Arial", 12), bg="#4CAF50", fg="white", compound="top").grid(row=0, column=2, padx=5, pady=5)
        tk.Button(self.button_frame, text="Close Ticket", image=self.close_img, command=lambda: self.change_ticket_status('closed'), font=("Arial", 12), bg="#f44336", fg="white", compound="top").grid(row=0, column=3, padx=5, pady=5)
        tk.Button(self.button_frame, text="Hold Ticket", image=self.hold_img, command=lambda: self.change_ticket_status('on hold'), font=("Arial", 12), bg="#FFC107", fg="white", compound="top").grid(row=0, column=4, padx=5, pady=5)
        tk.Button(self.button_frame, text="Respond to Ticket", image=self.respond_img, command=self.respond_ticket, font=("Arial", 12), bg="#4CAF50", fg="white", compound="top").grid(row=1, column=0, padx=5, pady=5)
        tk.Button(self.button_frame, text="Delete Ticket", image=self.delete_img, command=self.delete_ticket, font=("Arial", 12), bg="#f44336", fg="white", compound="top").grid(row=1, column=1, padx=5, pady=5)
        tk.Button(self.button_frame, text="Assign Ticket", image=self.assign_img, command=self.assign_ticket, font=("Arial", 12), bg="#4CAF50", fg="white", compound="top").grid(row=1, column=2, padx=5, pady=5)

    def show_tickets(self):
        tickets = fetch_tickets()
        filter_type = self.filter_combobox.get()
        filtered_tickets = self.filter_tickets(tickets, filter_type)
        self.tickets_listbox.delete(0, tk.END)
        for ticket in filtered_tickets:
            self.tickets_listbox.insert(tk.END, f"{ticket['id']} - {ticket['title']} - {ticket['status']}")

    def filter_tickets(self, tickets, filter_type):
        if filter_type == "all":
            return tickets
        elif filter_type == "assigned_to_me":
            return [ticket for ticket in tickets if ticket['assigned_to'] == user_id]
        else:
            return [ticket for ticket in tickets if ticket['status'] == filter_type]

    def view_ticket(self):
        try:
            selected_ticket = self.tickets_listbox.get(self.tickets_listbox.curselection())
            ticket_id = selected_ticket.split(" - ")[0]
            ticket = view_ticket(ticket_id)
            tags = ", ".join([tag['name'] for tag in ticket.get('tags', [])])
            messagebox.showinfo("Ticket Details", f"Title: {ticket['title']}\nMessage: {ticket['message']}\nStatus: {ticket['status']}\nPriority: {ticket['priority']}\nTags: {tags}\nUser: {ticket['user']['email']}\nAssigned to: {ticket['assigned_to']}")
        except IndexError:
            messagebox.showerror("Error", "No ticket selected")
        except requests.exceptions.RequestException as e:
            messagebox.showerror("Error", f"Failed to fetch ticket details: {e}")

    def change_ticket_status(self, status):
        try:
            selected_ticket = self.tickets_listbox.get(self.tickets_listbox.curselection())
            ticket_id = selected_ticket.split(" - ")[0]
            update_ticket_status(ticket_id, status)
            messagebox.showinfo("Success", "Ticket status updated successfully")
            self.show_tickets()
        except IndexError:
            messagebox.showerror("Error", "No ticket selected")
        except requests.exceptions.RequestException as e:
            messagebox.showerror("Error", f"Failed to update ticket status: {e}")

    def respond_ticket(self):
        try:
            selected_ticket = self.tickets_listbox.get(self.tickets_listbox.curselection())
            ticket_id = selected_ticket.split(" - ")[0]
            response_message = simpledialog.askstring("Response", "Enter your response:")
            if response_message:
                respond_ticket(ticket_id, response_message)
                messagebox.showinfo("Success", "Response sent successfully")
        except IndexError:
            messagebox.showerror("Error", "No ticket selected")
        except requests.exceptions.RequestException as e:
            messagebox.showerror("Error", f"Failed to send response: {e}")

    def create_ticket(self):
        try:
            title = simpledialog.askstring("Create Ticket", "Enter the ticket title:")
            message = simpledialog.askstring("Create Ticket", "Enter the ticket message:")
            priority = simpledialog.askstring("Create Ticket", "Enter the ticket priority (low, medium, high):")
            tags = simpledialog.askstring("Create Ticket", "Enter the tags (comma separated):")
            if title and message and priority and tags:
                tag_list = [tag.strip() for tag in tags.split(',')]
                response = create_ticket(title, message, priority, tag_list)
                if response:  # Vérifiez si la réponse est valide
                    messagebox.showinfo("Success", "Ticket created successfully")
                self.show_tickets()
        except requests.exceptions.RequestException as e:
            messagebox.showerror("Error", f"Failed to create ticket: {e}")
        except json.JSONDecodeError as e:
            messagebox.showerror("Error", f"Failed to parse response: {e}")

    def delete_ticket(self):
        try:
            selected_ticket = self.tickets_listbox.get(self.tickets_listbox.curselection())
            ticket_id = selected_ticket.split(" - ")[0]
            delete_ticket(ticket_id)
            messagebox.showinfo("Success", "Ticket deleted successfully")
            self.show_tickets()
        except IndexError:
            messagebox.showerror("Error", "No ticket selected")
        except requests.exceptions.RequestException as e:
            messagebox.showerror("Error", f"Failed to delete ticket: {e}")

    def assign_ticket(self):
        try:
            selected_ticket = self.tickets_listbox.get(self.tickets_listbox.curselection())
            ticket_id = selected_ticket.split(" - ")[0]
            assign_ticket(ticket_id)
            messagebox.showinfo("Success", "Ticket assigned successfully")
            self.show_tickets()
        except IndexError:
            messagebox.showerror("Error", "No ticket selected")
        except requests.exceptions.RequestException as e:
            messagebox.showerror("Error", f"Failed to assign ticket: {e}")