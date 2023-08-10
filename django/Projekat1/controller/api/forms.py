from django import forms
from .models import Case, Task, Document

class CaseForm(forms.ModelForm):
    class Meta:
        model = Case
        fields = '__all__'

class TaskForm(forms.ModelForm):
    class Meta:
        model = Task
        fields = '__all__'

class DocumentForm(forms.ModelForm):
    class Meta:
        model = Document
        fields = ('file',)
