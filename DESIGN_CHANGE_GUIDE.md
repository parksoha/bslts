# 디자인 변경 가이드

## 📋 분석 결과

현재 코드 구조를 분석한 결과, **데이터베이스나 PHP 로직을 건드리지 않고 오로지 디자인만 변경**할 수 있습니다.

---

## 🎨 디자인 변경 가능한 영역

### 1. **CSS 파일** (주요 디자인 파일)
- **`css/style2.css`** - 메인 스타일시트 (반응형 디자인 포함)
- `css/common.css` - 공통 스타일
- `css/board_common.css` - 게시판 스타일

### 2. **인라인 스타일** (페이지 내부)
- `index2_e.php`의 12-26줄: `<style>` 태그 내 스타일
- 각 HTML 요소의 `style=""` 속성

### 3. **이미지 파일**
- `/images/` - 한국어 버전 이미지
- `/images_e/` - 영어 버전 이미지
- `/images_j/` - 일본어 버전 이미지

---

## 🔧 디자인 변경 방법

### 방법 1: CSS 파일 수정 (권장)

#### 주요 CSS 클래스/ID 목록

**메인 페이지 섹션:**
- `.s4` - 데스크톱 메인 배너 영역
- `.s5` - 모바일 메인 배너 영역
- `.noti_ban` - 공지사항 배너
- `.main_insdu2` - 게시판 영역
- `.call_bansd`, `.call_bansd2`, `.call_bansd3` - 연락처 영역

**메뉴/링크 스타일:**
- `.main_menu_link` - 메인 메뉴 링크 (현재: 흰색, 투명도 0.9)
- `.main_banner_link` - 배너 링크 (현재: 검은색)
- `.main_banner_link_over` - 활성 배너 링크 (현재: 파란색 배경)

**색상 코드 (현재 사용 중):**
- 메인 색상: `#00468a` (파란색)
- 배경: `#d7dcdb` (회색)
- 텍스트: `#ffffff` (흰색), `#000000` (검은색)
- 테두리: `#e4edf6`, `#d9d1d1`

#### 예시: 색상 변경하기

```css
/* css/style2.css 파일에서 */

/* 메인 메뉴 링크 색상 변경 */
a.main_menu_link {
    color: #your-color;  /* 원하는 색상으로 변경 */
}

/* 배너 링크 배경색 변경 */
a.main_banner_link_over {
    background: #your-color;  /* 원하는 색상으로 변경 */
}
```

---

### 방법 2: 인라인 스타일 오버라이드

`index2_e.php`의 인라인 스타일을 변경하지 않고, CSS 파일에서 오버라이드:

```css
/* css/style2.css 파일 끝에 추가 */

/* 인라인 스타일 오버라이드 */
.noti_ban .titsf span {
    border-top-color: #your-color !important;
}

.s4 ul li {
    background-color: #your-color !important;
}
```

---

### 방법 3: 이미지 교체

이미지만 교체하면 디자인이 바뀝니다:

**교체 가능한 이미지:**
- `/images/main1.png`, `/images/main2.png`, `/images/main3.png`, `/images/main4.png` - 메인 배너
- `/images/main1_neum.png`, `/images/main2_neum.png` 등 - 메인 아이콘
- `/images_e/main_banner_cs_bg.png` - 고객 서비스 배경
- `/images/main_cs_bg3.png` - 연락처 배경

**주의:** 파일명과 경로는 그대로 유지하고 이미지만 교체하세요.

---

## 📱 반응형 디자인 구조

`css/style2.css`는 3가지 화면 크기에 맞춰 설계되어 있습니다:

1. **모바일** (0px ~ 689px)
   - `.s5` 표시, `.s4` 숨김
   - `.call_bansd3` 표시

2. **태블릿** (690px ~ 1023px)
   - `.s4` 표시, `.s5` 숨김
   - `.call_bansd2` 표시

3. **데스크톱** (1024px 이상)
   - `.s4` 표시
   - `.call_bansd` 표시
   - `.main_insdu2_pc` 표시

---

## ⚠️ 주의사항

### ✅ 해도 되는 것:
- CSS 파일 수정
- 이미지 파일 교체
- 색상, 폰트, 크기 변경
- 레이아웃 간격 조정

### ❌ 하지 말아야 할 것:
- PHP 코드 수정 (로직 변경)
- 데이터베이스 쿼리 수정
- `rg_lastest()` 같은 함수 호출 제거
- `$_site_info` 변수 사용 제거

---

## 🎯 빠른 시작 예시

### 예시 1: 메인 색상 변경

`css/style2.css` 파일에서 다음을 검색하여 변경:

```css
/* 기존 */
color: #00468a;
background: #00468a;

/* 변경 예시 */
color: #ff6b6b;  /* 빨간색으로 */
background: #ff6b6b;
```

### 예시 2: 폰트 크기 변경

```css
/* 기존 */
font-size: 1.5em;

/* 변경 */
font-size: 2em;  /* 더 크게 */
```

### 예시 3: 배경 이미지 변경

`/images/main1.png` 파일을 원하는 이미지로 교체 (파일명 유지)

---

## 📂 관련 파일 위치

```
bs/
├── index2_e.php          # 영어 메인 페이지
├── index2.php            # 한국어 메인 페이지
├── css/
│   ├── style2.css        # ⭐ 메인 스타일시트
│   ├── common.css
│   └── board_common.css
├── images/               # 한국어 이미지
├── images_e/             # 영어 이미지
└── include/
    ├── header2_e.php     # 영어 헤더 (CSS 로드)
    └── footer3_e.php     # 영어 푸터
```

---

## 💡 팁

1. **CSS 변경 전 백업**: `css/style2.css` 파일을 먼저 백업하세요.
2. **브라우저 개발자 도구**: F12로 요소를 선택하고 어떤 CSS가 적용되는지 확인하세요.
3. **점진적 변경**: 한 번에 많이 바꾸지 말고, 하나씩 변경하며 테스트하세요.
4. **반응형 테스트**: 모바일, 태블릿, 데스크톱에서 모두 확인하세요.

---

## 🔍 현재 디자인 요소 확인 방법

브라우저에서 `index2_e.php`를 열고:
1. F12 (개발자 도구) 열기
2. 요소 선택 도구로 원하는 부분 클릭
3. 우측 스타일 패널에서 적용된 CSS 확인
4. 해당 CSS 클래스명을 `css/style2.css`에서 검색하여 수정

---

## ❓ 질문

어떤 부분의 디자인을 변경하고 싶으신가요?
- 색상 변경
- 레이아웃 변경
- 폰트 변경
- 이미지 교체
- 기타

원하시는 변경 사항을 알려주시면 구체적인 가이드를 제공하겠습니다!

