# 🚀 빠른 시작 가이드 (5분 안에!)

## Windows 사용자 - XAMPP 사용

### 1단계: XAMPP 설치 (2분)
1. https://www.apachefriends.org/download.html 접속
2. XAMPP 다운로드 및 설치
3. 설치 시 **Apache**, **MySQL**, **PHP** 선택

### 2단계: 프로젝트 복사 (1분)
```bash
# 프로젝트 폴더를 XAMPP htdocs로 복사
C:\xampp\htdocs\bs\
```

### 3단계: 데이터베이스 설정 (1분)

#### 3-1. XAMPP Control Panel 실행
- Apache와 MySQL **Start** 클릭

#### 3-2. phpMyAdmin 접속
- 브라우저에서: http://localhost/phpmyadmin
- 왼쪽에서 "새로 만들기" 클릭
- 데이터베이스 이름: `bs_local`
- 인코딩: `utf8_general_ci`
- "만들기" 클릭

#### 3-3. DB 설정 파일 생성
1. `wb_data` 폴더에 `db_info.php` 파일 생성
2. 다음 내용 입력:

```php
<?
localhost
root

bs_local
MYSQL
3306
?>
```

**중요:** 
- 3번째 줄(비밀번호)은 XAMPP 기본값이므로 **빈 줄**로 두세요
- 각 줄 끝에 공백이나 다른 문자가 없어야 합니다

### 4단계: 접속 확인 (1분)
브라우저에서 접속:
- http://localhost/bs/index.php
- 또는 직접: http://localhost/bs/index2_e.php

---

## Mac 사용자 - MAMP 사용

### 1단계: MAMP 설치
1. https://www.mamp.info/en/downloads/ 접속
2. MAMP 다운로드 및 설치

### 2단계: 프로젝트 복사
```bash
# 프로젝트를 MAMP htdocs로 복사
/Applications/MAMP/htdocs/bs/
```

### 3단계: MAMP 시작
1. MAMP 실행
2. "Start Servers" 클릭

### 4단계: 데이터베이스 설정
1. phpMyAdmin: http://localhost:8888/phpmyadmin
2. 데이터베이스 `bs_local` 생성
3. `wb_data/db_info.php` 파일 생성:

```php
<?
localhost
root
root
bs_local
MYSQL
8889
?>
```

**주의:** MAMP는 MySQL 포트가 8889입니다.

### 5단계: 접속
- http://localhost:8888/bs/index2_e.php

---

## Linux 사용자 - PHP 내장 서버

### 1단계: PHP와 MySQL 설치
```bash
# Ubuntu/Debian
sudo apt-get update
sudo apt-get install php mysql-server php-mysql

# CentOS/RHEL
sudo yum install php mysql-server php-mysql
```

### 2단계: MySQL 설정
```bash
# MySQL 시작
sudo systemctl start mysql

# 데이터베이스 생성
mysql -u root -p
CREATE DATABASE bs_local CHARACTER SET utf8 COLLATE utf8_general_ci;
EXIT;
```

### 3단계: DB 설정 파일 생성
```bash
cd /path/to/bs
cat > wb_data/db_info.php << 'EOF'
<?
localhost
root
your_password_here
bs_local
MYSQL
3306
?>
EOF
```

### 4단계: 서버 실행
```bash
php -S localhost:8000
```

### 5단계: 접속
- http://localhost:8000/index2_e.php

---

## ⚠️ 문제 해결

### "데이터베이스 접속에러" 발생 시

1. **MySQL이 실행 중인지 확인**
   - XAMPP: Control Panel에서 MySQL이 녹색인지 확인
   - Linux: `sudo systemctl status mysql`

2. **db_info.php 파일 형식 확인**
   - 각 줄이 정확히 하나씩인지 확인
   - 줄 끝에 공백이나 특수문자 없는지 확인
   - 파일 인코딩: UTF-8 (BOM 없음)

3. **권한 문제 (Linux/Mac)**
   ```bash
   chmod 777 wb_data/session/
   chmod 777 wb_data/board/
   ```

### 이미지가 안 보일 때

이미지 경로가 `/images/`로 시작하는 경우:
- XAMPP/MAMP: 정상 작동
- PHP 내장 서버: `.htaccess` 또는 가상 호스트 필요

임시 해결: 이미지 경로를 상대 경로로 변경
```php
<!-- 기존 -->
<img src="/images/main1.png">

<!-- 변경 -->
<img src="./images/main1.png">
```

---

## ✅ 성공 확인

다음이 모두 작동하면 성공입니다:

- [ ] 메인 페이지가 표시됨
- [ ] 메뉴 클릭 시 페이지 이동
- [ ] 이미지가 정상 표시됨
- [ ] CSS 스타일이 적용됨

**게시판 기능**은 데이터베이스가 초기화되어야 작동합니다.
초기화는 `wb_admin/install.php`를 통해 진행하거나,
기존 서버에서 DB를 백업받아 복원하세요.

---

## 📝 다음 단계

로컬 환경이 구축되면:
1. 디자인 리뉴얼 작업 시작
2. 코드 수정 및 테스트
3. 변경사항 확인

**주의:** 실제 서버 파일은 절대 수정하지 마세요!
로컬에서만 작업하고, 완료 후 서버에 업로드하세요.





