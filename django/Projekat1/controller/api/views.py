from django.shortcuts import render, redirect
from django.contrib.auth.views import LoginView
from datetime import date
from .models import Case, Task, Document, Meeting, Payment
from .forms import CaseForm, DocumentForm, TaskForm

def dashboard(request):
    total_cases = Case.objects.all().count()
    active_cases = Case.objects.filter(status='active').count()
    completed_cases = Case.objects.filter(status='completed').count()
    pending_cases = Case.objects.filter(status='pending').count()

    # Calculate financial data and prepare it for the graph
    financial_data = get_financial_data_for_graph()

    # Fetch active tasks for today
    today = date.today()
    active_tasks_today = Task.objects.filter(deadline=today, status='active')

    context = {
        'total_cases': total_cases,
        'active_cases': active_cases,
        'completed_cases': completed_cases,
        'pending_cases': pending_cases,
        'financial_data': financial_data,
        'active_tasks_today': active_tasks_today,
    }

    return render(request, 'dashboard.html', context)

class CustomLoginView(LoginView):
    template_name = 'login.html'

def cases(request):
    total_cases = Case.objects.all().count()
    todo_cases = Case.objects.filter(status='todo').count()
    finished_cases = Case.objects.filter(status='finished').count()
    cases = Case.objects.all()

    if request.method == 'GET':
        search_query = request.GET.get('search', '')
        if search_query:
            cases = cases.filter(name__icontains=search_query)

    context = {
        'total_cases': total_cases,
        'todo_cases': todo_cases,
        'finished_cases': finished_cases,
        'cases': cases,
        'search_query': search_query,
    }

    return render(request, 'cases.html', context)

def add_case(request):
    if request.method == 'POST':
        form = CaseForm(request.POST)
        if form.is_valid():
            form.save()
            # Redirect to cases page after successful addition
            return redirect('cases')
    else:
        form = CaseForm()

    context = {
        'form': form,
    }

    return render(request, 'add_case.html', context)

def documents(request):
    documents = Document.objects.all()

    if request.method == 'POST':
        form = DocumentForm(request.POST, request.FILES)
        if form.is_valid():
            form.save()
            return redirect('documents')
    else:
        form = DocumentForm()

    context = {
        'documents': documents,
        'form': form,
    }

    return render(request, 'documents.html', context)

def tasks(request):
    total_tasks = Task.objects.all().count()
    todo_tasks = Task.objects.filter(status='todo').count()
    finished_tasks = Task.objects.filter(status='finished').count()
    tasks = Task.objects.all()

    if request.method == 'GET':
        search_query = request.GET.get('search', '')
        if search_query:
            tasks = tasks.filter(name__icontains=search_query)

    context = {
        'total_tasks': total_tasks,
        'todo_tasks': todo_tasks,
        'finished_tasks': finished_tasks,
        'tasks': tasks,
        'search_query': search_query,
    }

    return render(request, 'tasks.html', context)

def add_task(request):
    if request.method == 'POST':
        form = TaskForm(request.POST)
        if form.is_valid():
            form.save()
            # Redirect to tasks page after successful addition
            return redirect('tasks')
    else:
        form = TaskForm()

    context = {
        'form': form,
    }

    return render(request, 'add_task.html', context)

def calendar(request):
    tasks = Task.objects.all()

    context = {
        'tasks': tasks,
    }

    return render(request, 'calendar.html', context)


def financial_reports(request):
    finished_cases = Case.objects.filter(status='finished').count()
    unfinished_cases = Case.objects.filter(status='active').count()

    total_profit = calculate_total_profit()
    total_salary = calculate_total_salary()
    total_payments = Payment.objects.all().count()
    completed_meetings = Meeting.objects.filter(status='completed').count()

    context = {
        'finished_cases': finished_cases,
        'unfinished_cases': unfinished_cases,
        'total_profit': total_profit,
        'total_salary': total_salary,
        'total_payments': total_payments,
        'completed_meetings': completed_meetings,
    }

    return render(request, 'financial_reports.html', context)