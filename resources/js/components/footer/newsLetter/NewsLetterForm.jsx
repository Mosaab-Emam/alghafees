const NewsLetterForm = () => {
    return (
        <form className="h-12 md:h-14 lg:h-16 flex flex-col self-stretch rounded-br-[50px] rounded-tl-[50px] border border-primary-400 bg-bg-01">
            <div className="w-full h-full flex justify-between items-center">
                <input
                    type="email"
                    placeholder="ادخل بريدك الالكتروني هنا"
                    className="w-full h-full bg-transparent outline-none border-none regular-b1 placeholder:text-Gray-scale-03 text-primary-500 text-right p-8"
                />
                <button className="flex flex-col justify-center items-center gap-[10px] md:self-stretch self-end md:py-[15px] py-3 md:px-[48px] lg:px-[64px] xl:px-[80px] px-[32px] rounded-br-[25px] rounded-tl-[25px] bg-primary-600 text-[16px] leading-normal font-norma text-bg-01 uppercase">
                    ارسال
                </button>
            </div>
        </form>
    );
};

export default NewsLetterForm;
