from django.db import models

# Case model
class Case(models.Model):
    STATUS_CHOICES = [
        ('active', 'Active'),
        ('pending', 'Pending'),
        ('completed', 'Completed'),
    ]
    
    name = models.CharField(max_length=200)
    status = models.CharField(max_length=20, choices=STATUS_CHOICES)
    about = models.TextField()
    opponents = models.CharField(max_length=200)
    associates = models.CharField(max_length=200)
    client = models.CharField(max_length=200)
    assignments = models.TextField()
    case_number = models.CharField(max_length=20)
    category = models.CharField(max_length=50)
    value_of_dispute = models.DecimalField(max_digits=10, decimal_places=2)
    date_of_receipt = models.DateField()

    def __str__(self):
        return self.name

# Task model
class Task(models.Model):
    PRIORITY_CHOICES = [
        ('high', 'High'),
        ('medium', 'Medium'),
        ('low', 'Low'),
    ]
    
    STATUS_CHOICES = [
        ('todo', 'To-Do'),
        ('finished', 'Finished'),
    ]
    
    name = models.CharField(max_length=200)
    priority = models.CharField(max_length=20, choices=PRIORITY_CHOICES)
    about = models.TextField()
    type = models.CharField(max_length=50)
    assignment = models.CharField(max_length=200)
    client = models.CharField(max_length=200)
    deadline = models.DateField()
    status = models.CharField(max_length=20, choices=STATUS_CHOICES)
    connected_case = models.ForeignKey(Case, on_delete=models.SET_NULL, null=True, blank=True)
    associates = models.CharField(max_length=200)
    add_to_calendar = models.BooleanField(default=False)

    def __str__(self):
        return self.name

# Document model
class Document(models.Model):
    file = models.FileField(upload_to='documents/')

    def __str__(self):
        return self.file.name

# Meeting model
class Meeting(models.Model):
    STATUS_CHOICES = [
        ('scheduled', 'Scheduled'),
        ('completed', 'Completed'),
        ('canceled', 'Canceled'),
    ]
    
    name = models.CharField(max_length=200)
    date = models.DateField()
    time = models.TimeField()
    location = models.CharField(max_length=200)
    status = models.CharField(max_length=20, choices=STATUS_CHOICES)
    description = models.TextField()
    attendees = models.TextField()

    def __str__(self):
        return self.name

# Payment model
class Payment(models.Model):
    payment_date = models.DateField()
    amount = models.DecimalField(max_digits=10, decimal_places=2)
    description = models.TextField()

    def __str__(self):
        return f'Payment: {self.amount}'
