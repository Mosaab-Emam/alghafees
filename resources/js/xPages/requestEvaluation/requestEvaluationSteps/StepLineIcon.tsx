import React from "react";

const StepLineIcon = ({ step, item, isDone }) => {
	return (
		<div className='w-full h-[70px] flex justify-center items-center'>
			{isDone ? (
				<svg
					xmlns='http://www.w3.org/2000/svg'
					width='4'
					height='74'
					viewBox='0 0 4 74'
					fill='none'>
					<path
						className={` stroke-Black-01 transition-colors duration-700 ease-linear`}
						d='M2 2V72'
						strokeWidth='3'
						strokeLinecap='round'
					/>
				</svg>
			) : (
				<svg
					xmlns='http://www.w3.org/2000/svg'
					width='4'
					height='74'
					viewBox='0 0 4 74'
					fill='none'>
					<path
						className={`${
							step >= item.id ? " stroke-primary-600" : " stroke-Gray-scale-04"
						}  transition-colors duration-700 ease-linear`}
						d='M2 2V72'
						strokeWidth='3'
						strokeLinecap='round'
					/>
				</svg>
			)}
		</div>
	);
};

export default StepLineIcon;
