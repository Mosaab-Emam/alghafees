import React from "react";

const NewsLetterForm = () => {
	return (
		<form className='h-[71px] flex flex-col justify-center items-center gap-[10px] self-stretch py-[10px] px-[20px] rounded-br-[50px] rounded-tl-[50px] border border-primary-400 bg-bg-01'>
			<div className='lg:w-[500px] xl:w-[753px] w-full flex justify-between items-center'>
				<input
					type='email'
					placeholder='ادخل بريدك الالكتروني هنا'
					className='w-full h-full bg-transparent outline-none border-none regular-b1 placeholder:text-Gray-scale-03 text-primary-500 text-right'
				/>
				<button className='flex flex-col justify-center items-center gap-[10px] md:self-stretch self-end md:py-[15px] py-3 lg:px-[60px] xl:px-[80px] px-[50px] rounded-br-[25px] rounded-tl-[25px] bg-primary-600 text-[16px] leading-normal font-norma text-bg-01 uppercase'>
					ارسال
				</button>
			</div>
		</form>
	);
};

export default NewsLetterForm;
