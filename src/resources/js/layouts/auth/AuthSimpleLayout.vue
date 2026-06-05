<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { home } from '@/routes';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <header class="header bg-primary" role="banner">
        <div class="toolbar-content">
            <div class="home-button-container">
                <Link :href="home()" class="home-button">
                    Home
                </Link>
            </div>
        </div>
    </header>
    <div class="main-container">
        <div class="content-wrapper">
            <div class="content">
                <div class="header-section">
                    <Link :href="home()" class="logo-link">
                        <div class="logo-wrapper">
                            <AppLogoIcon class="logo-icon" />
                        </div>
                        <span class="sr-only">{{ title }}</span>
                    </Link>
                    <div class="title-section">
                        <h1 class="title">{{ title }}</h1>
                        <p class="description">
                            {{ description }}
                        </p>
                    </div>
                </div>
                <slot />
            </div>
        </div>
    </div>
    <footer class="footer bg-primary" role="banner">
        <div class="footer-content"></div>
    </footer>
</template>

<style scoped>
.header {
    background-color: var(--primary);
    position: absolute;
    top: 0px;
    left: 0px;
    z-index: 910;
    width: 100%;
}

.toolbar-content {
    height: 48px;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    padding: 0 1rem;
}

.home-button-container {
    display: flex;
    align-items: center;
}

.home-button {
    padding: 0.5rem 1rem;
    background-color: rgba(255, 255, 255, 0.1);
    color: white;
    border-radius: 0.375rem;
    text-decoration: none;
    transition: background-color 0.2s;
}

.home-button:hover {
    background-color: rgba(255, 255, 255, 0.2);
}

.main-container {
    display: flex;
    min-height: 100vh;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 1.5rem;
    background-color: var(--background);
    padding: 1.5rem;
}

@media (min-width: 768px) {
    .main-container {
        padding: 2.5rem;
    }
}

.content-wrapper {
    width: 100%;
    max-width: 24rem;
}

.content {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.header-section {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
}

.logo-link {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    font-weight: 500;
    text-decoration: none;
}

.logo-wrapper {
    display: flex;
    height: 2.25rem;
    width: 2.25rem;
    align-items: center;
    justify-content: center;
    border-radius: 0.375rem;
    margin-bottom: 0.25rem;
}

.logo-icon {
    height: 2.25rem;
    width: 2.25rem;
    fill: currentColor;
    color: var(--foreground);
}

:global(.dark) .logo-icon {
    color: white;
}

.title-section {
    text-align: center;
}

.title {
    font-size: 1.25rem;
    font-weight: 500;
    margin: 0;
}

.description {
    text-align: center;
    font-size: 0.875rem;
    color: var(--muted-foreground);
    margin-top: 0.5rem;
}

.footer {
    background-color: var(--primary);
    position: absolute;
    bottom: 0px;
    left: 0px;
    z-index: 910;
    width: 100%;
}

.footer-content {
    height: 48px;
}

/* Utility classes */
.sr-only {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border-width: 0;
}
</style>