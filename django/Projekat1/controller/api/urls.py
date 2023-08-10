from django.urls import path
from . import views

urlpatterns = [
    path('dashboard/', views.dashboard, name='dashboard'),
    path('login/', views.CustomLoginView.as_view(), name='login'),
    path('cases/', views.cases, name='cases'),
    path('add_case/', views.add_case, name='add_case'),
    path('documents/', views.documents, name='documents'),
    path('tasks/', views.tasks, name='tasks'),
    path('calendar/', views.calendar, name='calendar'),
    path('financial_reports/', views.financial_reports, name='financial_reports'),
    path('add_task/', views.add_task, name='add_task'),
]
