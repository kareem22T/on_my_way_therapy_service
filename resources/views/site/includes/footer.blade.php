<footer>
    <div class="container">
        <div>
            <h3>Therapy Anywhere – Anytime</h3>
            <div>
                @foreach (App\Models\Profession::all() as $profession)
                    <a href="/specialization/{{ $profession->id }}" target="_blanck" class="profession">
                        <h4>{{ $profession->title }}</h4>
                    </a>
                @endforeach
            </div>
        </div>
        <hr>
        <div>
            <h4>Contact us or leave feedback</h4>
            <div class="contact">
                <div>
                    <a href="https://www.linkedin.com/company/94288210/admin/" target="_blanck">
                        <i class="fa-brands fa-linkedin"></i>
                    </a>
                    <a href="https://www.facebook.com/profile.php?id=100092588026660" target="_blanck">
                        <i class="fa-brands fa-square-facebook"></i>
                    </a>
                    <a href="https://www.instagram.com/on_my_way_therapy_australia/"
                        target="_blanck">
                        <i class="fa-brands fa-square-instagram"></i>
                    </a>
                    <a href="https://www.youtube.com/@OnMyWayTherapy"
                        target="_blanck">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                    <a href="mailto:Info@onmywaytherapy.com.au">
                        <i class="fa-solid fa-envelope"></i>
                        <span>Info@onmywaytherapy.com.au</span>
                    </a>
                </div>
                <a href="tel:1800666992"><i class="fa fa-phone"></i> <span>1800 ON MY WAY</span></a>
            </div>
        </div>
        <div>
            <p>All rights received - On My Way Therapy Services @ {{ date('Y') }}</p>
            Mobile app coming soon
        </div>
    </div>
</footer>

<style>
    footer {
        text-align: center;
        color: #FFC400;
        padding: clamp(0.9375rem, calc(0.6793rem + 1.087vw), 1.5625rem) 0;
        height: auto;
        margin-top: 40px;
    }

    footer .container div:first-child div {
        gap: clamp(0.625rem, calc(0.3668rem + 1.087vw), 1.25rem);
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(clamp(8.75rem, calc(5.1359rem + 15.2174vw), 17.5rem), 1fr));
    }

    footer .container div:first-child h3 {
        font-weight: 700;
        font-size: clamp(1.375rem, calc(1.091rem + 1.1957vw), 2.0625rem);
        line-height: clamp(2.5rem, calc(2.2418rem + 1.087vw), 3.125rem);
        text-align: center;
        margin-bottom: 15px;
    }

    footer .container div:first-child div a {
        text-decoration: none;
    }

    footer .container div:first-child div a h4 {
        font-size: clamp(0.8125rem, calc(0.5285rem + 1.1957vw), 1.5rem);
        font-weight: 700 !important;
        text-align: center;
        color: #132F75;
        background: #FFFFFF;
        border-radius: 20px;
        padding: 15px;
    }

    footer .container div:first-child div a h4 {
        margin: 0
    }

    footer hr {
        height: 4px;
        margin: 25px 0;
        background: #FFC400;
        border-color: #FFC400;
    }

    footer .container div:nth-of-type(2) {
        display: flex;
        justify-content: space-between;
        flex-direction: column
    }

    footer .container div:nth-of-type(2) h4 {
        font-weight: 700;
        font-size: clamp(1.375rem, calc(1.091rem + 1.1957vw), 2.0625rem);
        line-height: clamp(1.25rem, calc(0.4755rem + 3.2609vw), 3.125rem);
        text-align: center;
    }

    footer .container div:nth-of-type(2) a {
        color: #132F75;
        text-decoration: none;
        font-size: clamp(0.9375rem, calc(0.7052rem + 0.9783vw), 1.5rem);
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 13px;
        margin: 5px 0;
    }

    @media (max-width: 599.98px) {
        footer .container div:nth-of-type(2) a span {
            display: none
        }

        .contact {
            justify-content: center !important;
        }
    }

    footer .container div:last-child {
        display: flex;
        justify-content: space-between;
        gap: clamp(0.625rem, calc(0.3668rem + 1.087vw), 1.25rem);
        font-size: clamp(0.8125rem, calc(0.4253rem + 1.6304vw), 1.75rem);
        margin-top: 15px;
    }

    .contact {
        background: #FFFFFE;
        border-radius: 20px;
        padding: 7px 20px;
    }

    .contact i {
        font-size: 28px;
    }

    .contact>div {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
    }

    @media (max-width: 899.98px) {

        footer .container>div:last-child,
        footer .container div:nth-of-type(2) {
            flex-direction: column
        }

        footer .container div:nth-of-type(2) h4 {
            margin-bottom: 10px
        }
    }

    footer p {
        margin: 0
    }

    @media (max-width: 599.98px) {
        footer {
            flex-direction: column;
        }
    }
</style>
