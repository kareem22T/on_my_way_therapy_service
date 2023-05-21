<footer>
    <div class="container">
        <div>
            <h3>We have it all! Allied Health:</h3>
            <div>
                @foreach (App\Models\Profession::all() as $profession)
                    <a href="" class="profession">
                        <h4>{{ $profession->title }}</h4>
                    </a>
                @endforeach
            </div>
        </div>
        <hr>
        <div>
            <h4>Contact us or leave a feedback</h4>
            <a href="mailto:Info@onmywaytherapy.com.au">
                <i class="fa-solid fa-envelope"></i>
                Info@onmywaytherapy.com.au
            </a>
            <a href="tel:1800666992"><i class="fa fa-phone"></i> 1800 ON MY WAY</a>
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
        margin-top: 15px;
    }

    footer .container div:first-child div {
        display: flex;
        justify-content: center;
        align-items: center;
        white-space: nowrap;
        flex-wrap: wrap;
        gap: 5px 30px;
    }

    footer .container div:first-child h3 {
        font-size: clamp(1.375rem, calc(1.1685rem + 0.8696vw), 1.875rem);
        margin-bottom: 15px;
    }

    footer .container div:first-child div a {
        color: #FFC400;
        text-decoration: none;
        font-size: clamp(0.9375rem, calc(0.7052rem + 0.9783vw), 1.5rem);
    }

    footer hr {
        height: 2px;
        margin: 25px 0;
        border-color: #FFC400
    }

    footer .container div:nth-of-type(2) {
        display: flex;
        justify-content: space-between;
    }

    footer .container div:nth-of-type(2) h4 {
        font-size: clamp(1.125rem, calc(0.8668rem + 1.087vw), 1.75rem);
    }

    footer .container div:nth-of-type(2) a {
        color: #FFC400;
        text-decoration: none;
        font-size: clamp(0.9375rem, calc(0.7052rem + 0.9783vw), 1.5rem);
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 13px;
        margin: 5px 0;
    }

    footer .container div:last-child {
        display: flex;
        justify-content: space-between;
        gap: clamp(0.625rem, calc(0.3668rem + 1.087vw), 1.25rem);
        font-size: clamp(0.8125rem, calc(0.4253rem + 1.6304vw), 1.75rem);
        margin-top: 15px;
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
