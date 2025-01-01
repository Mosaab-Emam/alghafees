import React from "react";

const FormInput = ({ type, placeholder, name, className, label }) => {
	return (
		<section className='flex flex-col items-start gap-[20px] self-stretch'>
			<div className=' flex flex-col items-start gap-[16px] self-stretch group'>
				<label
					htmlFor={name}
					className='regular-b1 text-right text-Gray-scale-02 group-focus-within:text-primary-600 transition-colors duration-300'>
					{label}
				</label>
				<input
					id={name}
					type={type}
					placeholder={placeholder}
					className=' w-[526px] text-right max-w-full  sm:h-[48px] lg:h-[46px] xl:h-[48px] flex justify-end items-center py-[13px] px-[16px] gap-[10px] bg-bg-02 border-[1px] border-transparent hover:border-primary-400 focus:border-primary-600 hover:bg-bg-01 focus:bg-bg-01 outline-none transition-all duration-300'
				/>
			</div>
		</section>
	);
};

export default FormInput;
