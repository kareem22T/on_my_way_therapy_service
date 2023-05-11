<footer>
        <p>All rights received - On My Way Therapy Services @ {{date('Y')}}</p>
        Mobile app coming soon
</footer>

<style>
    footer{    
        font-weight: 700;
        font-size: clamp(0.8125rem, calc(0.3736rem + 1.8478vw), 1.875rem);
        line-height: clamp(1.125rem, calc(0.6087rem + 2.1739vw), 2.375rem);
        text-align: center;
        color: #FFC400;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: clamp(0.625rem, calc(0.3668rem + 1.087vw), 1.25rem);
        padding: clamp(0.9375rem, calc(0.6793rem + 1.087vw), 1.5625rem);
        height: auto;
        margin-top: 15px;
    }

    footer p {margin: 0}

    @media (max-width: 599.98px) {
        footer {
            flex-direction: column;
        }
    }
</style>