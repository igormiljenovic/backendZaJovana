from django.contrib import admin
from .models import Case, Task, Document, Meeting, Payment

admin.site.register(Case)
admin.site.register(Task)
admin.site.register(Document)
admin.site.register(Meeting)
admin.site.register(Payment)
