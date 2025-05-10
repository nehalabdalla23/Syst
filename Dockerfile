# استخدم صورة رسمية تحتوي على Python
FROM python:3.11-slim

# منع ظهور رسائل تحذيرية أثناء التثبيت
ENV PYTHONDONTWRITEBYTECODE=1
ENV PYTHONUNBUFFERED=1

# تثبيت التحديثات الأساسية (مهمة لتثبيت الحزم إن لزم الأمر)
RUN apt-get update && apt-get install -y --no-install-recommends gcc

# إعداد مجلد العمل داخل الصورة
WORKDIR /app

# نسخ ملفات المشروع
COPY hello.py /app/
# (اختياري) إذا كان لديك requirements.txt انسخه أيضًا:
# COPY requirements.txt /app/

# تثبيت Flask
RUN pip install --no-cache-dir flask==3.0.*

# الأمر الرئيسي لتشغيل التطبيق
CMD ["python3", "hello.py"]
