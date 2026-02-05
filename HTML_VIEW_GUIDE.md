# 📄 HTML 정적 파일 사용 가이드

## ✅ 생성된 파일

다음 4개의 정적 HTML 파일이 생성되었습니다:

1. **`index_static.html`** - 언어 선택 페이지 (시작 페이지)
2. **`index2_e_static.html`** - 영어 버전 (English)
3. **`index2_static.html`** - 한국어 버전 (한국어)
4. **`index2_j_static.html`** - 일본어 버전 (日本語)

---

## 🚀 사용 방법

### 방법 1: 브라우저에서 직접 열기 (가장 간단)

1. **`index_static.html`** 파일을 더블클릭 (언어 선택 페이지)
2. 또는 원하는 언어 파일을 직접 열기:
   - `index2_static.html` (한국어)
   - `index2_e_static.html` (영어)
   - `index2_j_static.html` (일본어)

**주의:** 일부 기능(JavaScript, 외부 리소스)은 제한될 수 있습니다.

---

### 방법 2: 로컬 서버 사용 (권장)

#### Python 사용 (가장 간단)

```bash
# Python 3
python -m http.server 8000

# Python 2
python -m SimpleHTTPServer 8000
```

브라우저에서: `http://localhost:8000/index2_e_static.html`

#### Node.js 사용

```bash
# http-server 설치 (한 번만)
npm install -g http-server

# 서버 실행
http-server -p 8000
```

브라우저에서: `http://localhost:8000/index2_e_static.html`

#### PHP 내장 서버

```bash
php -S localhost:8000
```

브라우저에서: `http://localhost:8000/index2_e_static.html`

---

## ⚠️ 주의사항

### 1. 이미지 경로
- 이미지 경로가 `./images/`로 변경되었습니다
- 실제 이미지 파일이 같은 폴더 구조에 있어야 합니다
- 이미지가 보이지 않으면 경로를 확인하세요

### 2. JavaScript 기능
- 메뉴 네비게이션 함수는 작동하지만 실제 페이지로 이동하지 않습니다
- 게시판 기능은 예시 HTML로 대체되었습니다

### 3. CSS 파일
- CSS 파일 경로가 `./css/`로 변경되었습니다
- 실제 CSS 파일이 있어야 스타일이 적용됩니다

### 4. 제한된 기능
- ❌ 게시판 목록 (예시 HTML로 대체)
- ❌ 회원 기능
- ❌ 데이터베이스 연동
- ✅ 디자인 및 레이아웃 확인 가능
- ✅ 정적 콘텐츠 표시

---

## 🔧 문제 해결

### 이미지가 안 보일 때

1. **이미지 경로 확인**
   - 파일 구조가 다음과 같아야 합니다:
   ```
   bs/
   ├── index2_e_static.html
   ├── images/
   │   ├── main1.png
   │   ├── main2.png
   │   └── ...
   ├── images_e/
   │   ├── m1.png
   │   └── ...
   └── css/
       └── style2.css
   ```

2. **상대 경로 확인**
   - HTML 파일과 이미지 폴더가 같은 레벨에 있는지 확인

### CSS가 적용되지 않을 때

1. **CSS 파일 경로 확인**
   - `css/style2.css` 파일이 존재하는지 확인
   - 브라우저 개발자 도구(F12)에서 네트워크 탭 확인

2. **로컬 서버 사용**
   - 파일을 직접 열면 CORS 정책으로 일부 리소스가 로드되지 않을 수 있습니다
   - 로컬 서버를 사용하면 해결됩니다

### JavaScript가 작동하지 않을 때

1. **jQuery 로드 확인**
   - 인터넷 연결이 필요합니다 (jQuery CDN 사용)
   - 오프라인에서는 jQuery 파일을 다운로드해 사용하세요

2. **브라우저 콘솔 확인**
   - F12 → Console 탭에서 에러 메시지 확인

---

## 📝 변경 사항

### PHP → HTML 변환 내용

1. **PHP 변수 치환**
   - `$_site_info['admin_tel']` → `010-4668-0607`
   - `$_site_info['admin_fax']` → `02-1234-5678`
   - `$site_path` → `./`

2. **Include 파일 병합**
   - `header_e.php` → HTML head 섹션에 병합
   - `footer_e.php`, `footer2_e.php` → HTML 하단에 병합

3. **경로 변경**
   - `/images/` → `./images/`
   - `/css/` → `./css/`
   - 절대 경로 → 상대 경로

4. **PHP 함수 대체**
   - `rg_lastest()` → 예시 HTML 목록으로 대체

---

## 🎯 사용 목적

이 HTML 파일은 다음 목적으로 사용하세요:

✅ **디자인 확인**
- 레이아웃 확인
- 스타일 확인
- 반응형 디자인 테스트

✅ **프레젠테이션**
- 클라이언트에게 디자인 보여주기
- 오프라인에서 확인

✅ **개발 참고**
- HTML 구조 파악
- CSS 클래스 확인

❌ **실제 기능 테스트는 불가**
- 게시판 기능
- 회원 기능
- 데이터베이스 연동

---

## 💡 팁

### 빠른 미리보기

```bash
# 프로젝트 폴더에서
cd C:\Users\PRI\Desktop\sh\bs

# Python 서버 실행
python -m http.server 8000

# 브라우저에서
http://localhost:8000/index2_e_static.html
```

### 오프라인 사용

1. jQuery를 로컬에 다운로드
2. HTML에서 CDN 링크를 로컬 파일로 변경:
   ```html
   <!-- 기존 -->
   <script src="http://code.jquery.com/jquery-latest.min.js"></script>
   
   <!-- 변경 -->
   <script src="./js/jquery.js"></script>
   ```

---

## 📞 추가 도움

문제가 발생하면:
1. 브라우저 개발자 도구(F12) 확인
2. 콘솔 에러 메시지 확인
3. 네트워크 탭에서 로드 실패한 리소스 확인

