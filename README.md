# astro-starter

Persönliches Astro 6 + Tailwind 4 Starter Template für neue Webprojekte.

## Stack

- [Astro 6](https://astro.build) — Static Site Generator
- [Tailwind CSS 4](https://tailwindcss.com) — Utility-first CSS
- [astro-seo](https://github.com/jonasmerlin/astro-seo) — SEO-Komponente
- [@astrojs/sitemap](https://docs.astro.build/en/guides/integrations-guide/sitemap/) — Automatische Sitemap
- TypeScript (strict)

## Befehle

```bash
npm run dev       # Dev-Server → http://localhost:4321
npm run build     # Produktions-Build → ./dist/
npm run preview   # Vorschau des Builds
```

Demo-Seite aller Komponenten: http://localhost:4321/components

## Ordnerstruktur

```
src/
├── components/
│   ├── index.ts              # Alle Exports
│   ├── layout/
│   │   ├── Header.astro
│   │   ├── Footer.astro
│   │   └── PageHeader.astro
│   ├── legal/
│   │   └── CookieBanner.astro
│   ├── sections/
│   │   ├── Hero.astro
│   │   ├── SectionIntro.astro
│   │   ├── StatsBar.astro
│   │   ├── StepsNumbered.astro
│   │   └── LogoGrid.astro
│   ├── projekte/
│   │   └── ProjectGrid.astro
│   ├── leistungen/
│   │   ├── AccordionItem.astro
│   │   └── ServiceGrid.astro
│   ├── ueberuns/
│   │   ├── PersonCard.astro
│   │   ├── TeamGallery.astro
│   │   └── BiographyTable.astro
│   ├── karriere/
│   │   ├── BenefitsList.astro
│   │   ├── JobCard.astro
│   │   └── ImageGallery.astro
│   └── kontakt/
│       ├── ContactForm.astro
│       └── ContactInfo.astro
├── layouts/
│   └── BaseLayout.astro
├── pages/
│   ├── index.astro
│   ├── impressum.astro
│   ├── datenschutz.astro
│   ├── 404.astro
│   └── components.astro      # Demo (noindex)
└── styles/
    └── global.css            # Design Tokens
```

## Komponenten-Übersicht

### Layout
| Komponente | Props |
|---|---|
| `Header` | `logo`, `navItems`, `sticky?` |
| `Footer` | `navItems`, `companyName`, `year?` |
| `PageHeader` | `title`, `subtitle?`, `breadcrumb?` |

### Sections
| Komponente | Props |
|---|---|
| `Hero` | `headline`, `subline?`, `ctaLabel`, `ctaHref`, `ctaSecondaryLabel?`, `ctaSecondaryHref?`, `backgroundImage?`, `overlay?` |
| `SectionIntro` | `eyebrow?`, `title`, `text`, `ctaLabel?`, `ctaHref?`, `align?`, `maxWidth?` |
| `StatsBar` | `stats`, `background?` |
| `StepsNumbered` | `steps`, `layout?` |
| `LogoGrid` | `logos`, `title?`, `grayscale?` |

### Projekte
| Komponente | Props |
|---|---|
| `ProjectGrid` | `projects`, `filterable?` |

### Leistungen
| Komponente | Props |
|---|---|
| `AccordionItem` | `number`, `title`, `content`, `open?` |
| `ServiceGrid` | `services`, `columns?` |

### Über uns
| Komponente | Props |
|---|---|
| `PersonCard` | `name`, `role`, `image`, `bio?`, `expandable?` |
| `TeamGallery` | `images`, `columns?` |
| `BiographyTable` | `entries` |

### Karriere
| Komponente | Props |
|---|---|
| `BenefitsList` | `columns`, `title?` |
| `JobCard` | `image`, `title`, `description?`, `ctaLabel`, `ctaHref` |
| `ImageGallery` | `images`, `columns?` |

### Kontakt
| Komponente | Props |
|---|---|
| `ContactForm` | `action?`, `privacyHref?`, `fileUpload?`, `successMessage?` |
| `ContactInfo` | `company`, `address`, `email`, `phone?`, `mapLink?` |

## Checkliste pro Projekt

- [ ] **Domain** in `astro.config.mjs` → `site: 'https://DOMAIN.de'`
- [ ] **Domain** in `public/robots.txt` → Sitemap-URL
- [ ] **Farben** in `src/styles/global.css` → CSS Custom Properties unter `:root`
- [ ] **Schriften** in `global.css` → `--font-sans`, `--font-heading` anpassen + Google Fonts einbinden
- [ ] **Logo** in `BaseLayout.astro` → `logo` Prop anpassen oder Bild einbinden
- [ ] **Navigation** in `BaseLayout.astro` → `defaultNavItems` anpassen
- [ ] **Firmenname** in `BaseLayout.astro` → Footer `companyName` Prop
- [ ] **Impressum** befüllen → `src/pages/impressum.astro` (alle `[PLATZHALTER]`)
- [ ] **Datenschutz** befüllen → `src/pages/datenschutz.astro` (Hosting-Anbieter, Datum, alle `[PLATZHALTER]`)
- [ ] **OG-Bild** → `public/og-default.jpg` erstellen (1200×630 px)
- [ ] **Favicon** → `public/favicon.svg` und `public/favicon.ico` austauschen
