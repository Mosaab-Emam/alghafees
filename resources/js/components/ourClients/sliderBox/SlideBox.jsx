import React from "react";

const SlideBox = ({ item }) => {
	return (
		<>
			<div className='flex flex-col items-start self-stretch gap-6 mb-[32px]'>
				<div>{item.icon}</div>
				<p className='text-Black-02 text-right regular-b1'>{item.quote}</p>
			</div>

			<div className='flex md:flex-row flex-col-reverse content-center justify-between items-center self-stretch'>
				<div className='flex items-center  gap-[15px]'>
					<span className='md:w-[50px] w-[48px] sm:h-[48px] lg:h-[46px] xl:h-[48px] rounded-full object-cover '>
						<img src={item.avatar} alt='avatar' loading='lazy' />
					</span>

					<div className='py-[6px]'>
						<h6 className='h-[22px] self-stretch text-Black-01 regular-b1 '>
							{item.name}
						</h6>
						<p className=' self-stretch text-Gray-scale-02 font-normal text-[14px] leading-normal'>
							{item.job_title}
						</p>
					</div>
				</div>
				<div className='flex items-center justify-center self-end  gap-0'>
					<span className='ml-2 text-Gray-scale-02 font-normal text-[14px] leading-normal text-right'>
						{item.rate_count}.0
					</span>
					{[...Array(item.rate_count)].map((_, index) => (
						<span className='' key={index}>
							{item.rateIcon}
						</span>
					))}
				</div>
			</div>
		</>
	);
};

export default SlideBox;
