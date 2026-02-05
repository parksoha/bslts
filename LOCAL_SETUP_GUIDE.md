# 로컬 개발 환경 구축 가이드

## 📋 필요 사항

### 1. 필수 소프트웨어
- **PHP 7.4 이상** (레거시 코드 호환)
- **MySQL 5.7 이상** 또는 **MariaDB 10.3 이상**
- **웹 서버**: Apache 또는 Nginx (또는 PHP 내장 서버)

### 2. PHP 확장 모듈
- `mysqli` 또는 `mysql` (데이터베이스 연결)
- `session` (세션 관리)
- `mbstring` (다국어 지원)
- `gd` 또는 `imagick` (이미지 처리)

---

## 🚀 빠른 시작 (3가지 방법)

### 방법 1: XAMPP 사용 (Windows/Mac/Linux) ⭐ 추천

#### 1단계: XAMPP 설치
1. https://www.apachefriends.org/ 에서 XAMPP 다운로드
2. 설치 시 Apache, MySQL, PHP 선택

#### 2단계: 프로젝트 복사
```bash
# XAMPP 설치 경로로 이동
cd C:\xampp\htdocs\  # Windows
# 또는
cd /Applications/XAMPP/htdocs/  # Mac

# 프로젝트 폴더 복사
# 현재 프로젝트를 'bs' 폴더로 복사
```

#### 3단계: 데이터베이스 설정
1. XAMPP Control Panel 실행
2. Apache와 MySQL 시작
3. phpMyAdmin 접속: http://localhost/phpmyadmin
4. 새 데이터베이스 생성 (예: `bs_local`)

#### 4단계: DB 설정 파일 생성
`wb_data/db_info.php` 파일을 다음과 같이 수정:

```php
<?
//localhost
//root
//
//bs_local
//MYSQL
//3306
?>
```

**설명:**
- 1번째 줄: `<?` (PHP 시작 태그)
- 2번째 줄: DB 호스트 (localhost)
- 3번째 줄: DB 사용자명 (기본: root)
- 4번째 줄: DB 비밀번호 (XAMPP 기본: 비어있음)
- 5번째 줄: DB 이름 (생성한 DB명)
- 6번째 줄: DB 타입 (MYSQL)
- 7번째 줄: 포트 (3306)
- 8번째 줄: `?>` (PHP 종료 태그)

#### 5단계: 접속
브라우저에서: `http://localhost/bs/index.php`

---

### 방법 2: PHP 내장 서버 (간단한 테스트용)

#### 1단계: PHP 설치 확인
```bash
php -v
```

#### 2단계: 프로젝트 폴더에서 서버 실행
```bash
cd C:\Users\PRI\Desktop\sh\bs
php -S localhost:8000
```

#### 3단계: 접속
브라우저에서: `http://localhost:8000/index.php`

**주의:** 이 방법은 MySQL이 별도로 실행되어 있어야 합니다.

---

### 방법 3: Docker 사용 (고급)

#### docker-compose.yml 생성
```yaml
version: '3.8'
services:
  web:
    image: php:7.4-apache
    ports:
      - "8080:80"
    volumes:
      - .:/var/www/html
    depends_on:
      - db
  
  db:
    image: mysql:5.7
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: bs_local
    ports:
      - "3306:3306"
    volumes:
      - mysql_data:/var/lib/mysql

volumes:
  mysql_data:
```

#### 실행
```bash
docker-compose up -d
```

---

## ⚙️ 상세 설정

### 1. 데이터베이스 초기화

#### 옵션 A: 기존 DB 백업 복원
서버에서 DB를 백업받아 로컬에 복원:
```bash
# 서버에서 백업
mysqldump -u 사용자명 -p 데이터베이스명 > backup.sql

# 로컬에서 복원
mysql -u root -p bs_local < backup.sql
```

#### 옵션 B: 알지보드 설치 프로그램 사용
1. `http://localhost/bs/wb_admin/install.php` 접속
2. 설치 마법사 따라하기

### 2. 파일 권한 설정 (Linux/Mac)

```bash
# 세션 디렉토리 권한
chmod 777 wb_data/session/

# 업로드 디렉토리 권한
chmod 777 wb_data/board/
chmod 777 wb_data/member/
```

### 3. PHP 설정 확인

`php.ini` 파일에서 다음 설정 확인:

```ini
; 세션 활성화
session.save_path = "wb_data/session"
session.auto_start = 0

; 에러 표시 (개발용)
display_errors = On
error_reporting = E_ALL

; 파일 업로드
upload_max_filesize = 10M
post_max_size = 10M

; 시간대 설정
date.timezone = Asia/Seoul
```

---

## 🔧 문제 해결

### 문제 1: "데이터베이스 접속에러"
**해결:**
- `wb_data/db_info.php` 파일 형식 확인
- MySQL 서비스 실행 확인
- DB 사용자명/비밀번호 확인

### 문제 2: "세션 디렉토리 오류"
**해결:**
```bash
# 세션 디렉토리 생성 및 권한 설정
mkdir -p wb_data/session
chmod 777 wb_data/session
```

### 문제 3: "IP 기반 리다이렉트 문제"
`index.php`에서 IP 감지가 실패하면 영어 버전으로 기본 이동합니다.
직접 접속: `http://localhost/bs/index2_e.php`

### 문제 4: 이미지가 안 보임
**해결:**
- 이미지 경로가 `/images/`로 시작하는 경우
- `.htaccess` 파일 생성 또는 가상 호스트 설정 필요

---

## 📝 체크리스트

로컬 환경 구축 완료 확인:

- [ ] PHP 설치 및 실행 확인 (`php -v`)
- [ ] MySQL 설치 및 실행 확인
- [ ] `wb_data/db_info.php` 파일 생성 및 설정
- [ ] 데이터베이스 생성 및 연결 확인
- [ ] `http://localhost/bs/index.php` 접속 성공
- [ ] 메인 페이지 표시 확인
- [ ] 게시판 접근 확인
- [ ] 이미지 로드 확인

---

## 🎯 빠른 테스트

### 최소 설정으로 테스트하기

1. **DB 설정 파일만 생성**
   ```
   wb_data/db_info.php
   ```

2. **빈 데이터베이스 생성**
   ```sql
   CREATE DATABASE bs_local;
   ```

3. **PHP 내장 서버 실행**
   ```bash
   php -S localhost:8000
   ```

4. **직접 페이지 접속**
   - `http://localhost:8000/index2_e.php` (영어 버전)
   - `http://localhost:8000/index2.php` (한국어 버전)

**주의:** 게시판 기능은 DB가 초기화되어야 작동합니다.

---

## 💡 추가 팁

### 개발용 설정
- 에러 표시 활성화
- 캐시 비활성화
- 디버그 모드 활성화

### 프로덕션과 분리
- 로컬용 `db_info.php` 별도 관리
- Git에 실제 DB 정보 커밋하지 않기
- `.gitignore`에 `wb_data/db_info.php` 추가

---

## 📞 도움이 필요하신가요?

문제가 발생하면:
1. 브라우저 개발자 도구 (F12)에서 에러 확인
2. PHP 에러 로그 확인
3. MySQL 에러 로그 확인





