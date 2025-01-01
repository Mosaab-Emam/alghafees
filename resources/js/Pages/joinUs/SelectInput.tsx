// DropdownComponent.js
import React, { useState } from "react";

const SelectInput = () => {
	const [isOpen, setIsOpen] = useState(false);
	const [selectedOption, setSelectedOption] = useState("متدرب");

	const toggleDropdown = () => setIsOpen(!isOpen);

	const handleOptionClick = (option) => {
		setSelectedOption(option);
		setIsOpen(false);
	};

	return (
		<div className='flex flex-col items-start gap-[16px] self-stretch group'>
			<button
				type='button'
				className='w-[526px] text-right max-w-full  sm:h-[48px] lg:h-[46px] xl:h-[48px] flex justify-between items-center py-[13px] px-[16px] gap-[10px] bg-bg-02  '
				onClick={toggleDropdown}>
				<span
					className={`regular-b1 text-right ${
						isOpen ? "text-primary-600" : "text-Gray-scale-02"
					}`}>
					{selectedOption}
				</span>

				<svg
					className={`transition-transform duration-100 ease-in-out  transform ${
						isOpen ? "rotate-180" : "rotate-0"
					}`}
					xmlns='http://www.w3.org/2000/svg'
					width='12'
					height='8'
					viewBox='0 0 12 8'
					fill='none'>
					<path
						d='M11 1L6 6L1 1'
						stroke='#0F819F'
						strokeWidth='2'
						strokeLinecap='round'
					/>
				</svg>
			</button>
			{isOpen && (
				<section className='flex flex-col items-start self-stretch'>
					<div className=' w-[526px] max-w-full  flex flex-col items-start py-0  gap-1 bg-bg-02 border-[1px] border-transparent hover:border-primary-400 focus:border-primary-600  outline-none transition-all duration-300'>
						<div
							onClick={() => handleOptionClick("متدرب")}
							className='flex items-center gap-[454px] p-2 self-stretch bg-bg-02  px-[16px]   hover:bg-bg-01  transition-all duration-200'>
							<div className='flex justify-start items-center gap-4 flex-1 cursor-pointer'>
								<div className='relative flex items-center'>
									<input
										id='option-trainee'
										type='radio'
										name='role'
										value='متدرب'
										className='absolute w-0 h-0 opacity-0'
										checked={selectedOption === "متدرب"}
										onChange={() => handleOptionClick("متدرب")}
									/>
									<div
										className={`w-[18px] h-[18px] flex justify-center items-center rounded-[9px] border-2 ${
											selectedOption === "متدرب"
												? "bg-primary-600 border-primary-600"
												: "bg-bg-02 border-Gray-scale-01 hover:bg-bg-01 hover:border-[5px] hover:border-primary-600"
										} transition-all duration-200`}>
										{selectedOption === "متدرب" && (
											<div className='w-[8px] h-[8px] rounded-full bg-white' />
										)}
									</div>
								</div>

								<label
									htmlFor='option-trainee'
									className='regular-b1 text-right text-Gray-scale-03 cursor-default'>
									متدرب
								</label>
							</div>
						</div>
						<div
							onClick={() => handleOptionClick("موظف")}
							className='flex items-center gap-[454px] p-2 self-stretch bg-bg-02  px-[16px]  hover:bg-bg-01  transition-all duration-200'>
							<div className='flex justify-start items-center gap-4 flex-1 cursor-pointer'>
								<div className='relative flex items-center'>
									<input
										id='option-employee'
										type='radio'
										name='role'
										value='موظف'
										className='absolute w-0 h-0 opacity-0'
										checked={selectedOption === "موظف"}
										onChange={() => handleOptionClick("موظف")}
									/>
									<div
										className={`w-[18px] h-[18px] flex justify-center items-center rounded-[9px] border-2 ${
											selectedOption === "موظف"
												? "bg-primary-600 border-primary-600"
												: "bg-bg-02 border-Gray-scale-01 hover:bg-bg-01 hover:border-[5px] hover:border-primary-600"
										} transition-all duration-200`}>
										{selectedOption === "موظف" && (
											<div className='w-[8px] h-[8px] rounded-full bg-white' />
										)}
									</div>
								</div>
								<label
									htmlFor='option-employee'
									className='regular-b1 text-right text-Gray-scale-03 cursor-default'>
									موظف
								</label>
							</div>
						</div>
					</div>
				</section>
			)}
		</div>
	);
};

export default SelectInput;
