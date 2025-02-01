import { Link } from "@inertiajs/react";

export default function BlogPagination({ max_pages }: { max_pages: number }) {
    const params = new URLSearchParams(window.location.search);
    const search_query = params.get("search") ?? "";
    const current_page = parseInt(params.get("page") ?? "1");
    const max_visible_pages = 5;

    const renderPageNumbers = () => {
        const pageNumbers = [];

        for (let i = 1; i <= max_pages; i++) {
            if (
                i <= max_visible_pages ||
                i === max_pages ||
                i === current_page
            ) {
                pageNumbers.push(
                    <Link href={`/blog?page=${i}`} key={`page-number-${i}`}>
                        <button
                            className={`sm:h-[48px] lg:h-[46px] xl:h-[48px] flex justify-center items-center ${
                                i == current_page
                                    ? "text-primary-600"
                                    : "text-Gray-scale-02"
                            } hover:text-primary-600`}
                        >
                            {i}
                        </button>
                    </Link>
                );
            } else if (i === max_visible_pages + 1) {
                pageNumbers.push(
                    <span key={`ellipsis-${i}`} className="text-Gray-scale-02">
                        ...
                    </span>
                );
            }
        }
        return pageNumbers;
    };

    return (
        <section className="md:w-[483px] w-[250px] flex items-center md:gap-4 gap-2 mb-16">
            <Link href={`/blog?search=${search_query}`}>
                <button
                    className={`md:w-[50px] w-[48px] sm:h-[48px] lg:h-[46px] xl:h-[48px] flex justify-center items-center p-2 gap-[10px] rounded-tl-[8px] rounded-br-[8px] border ${
                        current_page == 1
                            ? "border-Gray-scale-03 bg-bg-01"
                            : "border-primary-600 bg-primary-600"
                    }`}
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="30"
                        height="29"
                        viewBox="0 0 30 29"
                        fill="none"
                    >
                        <path
                            opacity="0.971"
                            fillRule="evenodd"
                            clipRule="evenodd"
                            d="M18.3522 4.84014C18.7222 4.80403 19.0601 4.88851 19.3659 5.09356C22.2287 7.95629 25.0914 10.8191 27.9542 13.6818C28.2921 14.2074 28.2921 14.7331 27.9542 15.2587C25.0524 18.1793 22.1333 21.0796 19.197 23.9595C18.3345 24.3024 17.7244 24.049 17.3667 23.1993C17.2986 22.8396 17.3549 22.5017 17.5357 22.1856C19.6851 20.0361 21.8344 17.8868 23.9839 15.7373C16.9068 15.7186 9.82972 15.6998 2.75262 15.681C1.87678 15.422 1.56704 14.8495 1.8234 13.9634C2.00268 13.5591 2.31242 13.3244 2.75262 13.2594C9.82972 13.2407 16.9068 13.2219 23.9839 13.2031C21.8533 11.0725 19.7226 8.94183 17.592 6.81121C17.1432 5.87597 17.3967 5.21892 18.3522 4.84014Z"
                            fill={current_page == 1 ? "#808282" : "#FEFFFF"}
                        />
                    </svg>
                </button>
            </Link>
            <div className="flex sm:h-[48px] lg:h-[46px] xl:h-[48px] items-center md:gap-7 gap-6   py-[10px] md:px-8 px-4 rounded-tl-[10px] rounded-br-[10px] border border-primary-600">
                {renderPageNumbers()}
            </div>
            <Link href={`/blog?page=${max_pages}&search=${search_query}`}>
                <button
                    className={`md:w-[50px] w-[48px] sm:h-[48px] lg:h-[46px] xl:h-[48px] flex justify-center items-center p-2 gap-[10px] rounded-tr-[8px] rounded-bl-[8px] border ${
                        current_page == max_pages
                            ? "border-Gray-scale-03 bg-bg-01"
                            : "border-primary-600 bg-primary-600"
                    }`}
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="30"
                        height="29"
                        viewBox="0 0 30 29"
                        fill="none"
                    >
                        <path
                            opacity="0.971"
                            fillRule="evenodd"
                            clipRule="evenodd"
                            d="M11.6478 4.84014C11.2778 4.80403 10.9399 4.88851 10.6341 5.09356C7.77134 7.95629 4.90856 10.8191 2.04583 13.6818C1.70793 14.2074 1.70793 14.7331 2.04583 15.2587C4.94764 18.1793 7.86674 21.0796 10.803 23.9595C11.6655 24.3024 12.2756 24.049 12.6333 23.1993C12.7014 22.8396 12.6451 22.5017 12.4643 22.1856C10.3149 20.0361 8.16556 17.8868 6.01613 15.7373C13.0932 15.7186 20.1703 15.6998 27.2474 15.681C28.1232 15.422 28.433 14.8495 28.1766 13.9634C27.9973 13.5591 27.6876 13.3244 27.2474 13.2594C20.1703 13.2407 13.0932 13.2219 6.01613 13.2031C8.14675 11.0725 10.2774 8.94183 12.408 6.81121C12.8568 5.87597 12.6033 5.21892 11.6478 4.84014Z"
                            fill={
                                current_page == max_pages
                                    ? "#808282"
                                    : "#FEFFFF"
                            }
                        />
                    </svg>
                </button>
            </Link>
        </section>
    );
}
