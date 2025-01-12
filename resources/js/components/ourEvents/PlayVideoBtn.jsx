import React from "react";

const PlayVideoBtn = ({ onClick }) => {
	return (
		<div className='flex justify-center items-center'>
			{" "}
			<button
				onClick={onClick}
				className='lg:w-[50px] w-[48px] h-[48px] lg:h-[46px] xl:h-[48px] flex-shrink-0 flex justify-center items-center p-2 gap-[10px] bg-bg-01 rounded-tl-[16px] rounded-br-[16px] group hover:bg-primary-600 hover:opacity-100 transition duration-700 ease-in-out absolute inset-1/2'>
				<svg
					xmlns='http://www.w3.org/2000/svg'
					width='20'
					height='20'
					viewBox='0 0 20 20'
					fill='none'>
					<g clipPath='url(#clip0_139_10961)'>
						<path
							opacity='0.994'
							fillRule='evenodd'
							clipRule='evenodd'
							d='M2.39952 -0.0195312C2.65994 -0.0195312 2.92035 -0.0195312 3.18077 -0.0195312C3.57356 0.0791199 3.95116 0.228859 4.31358 0.429688C8.84483 3.03386 13.3761 5.63801 17.9073 8.24219C18.4134 8.55277 18.7585 8.98895 18.9425 9.55078C19.0761 10.1491 18.9459 10.683 18.5519 11.1523C18.3602 11.3702 18.1453 11.559 17.9073 11.7188C13.2326 14.4208 8.54506 17.1031 3.84483 19.7656C3.62006 19.8428 3.39871 19.9144 3.18077 19.9805C2.92035 19.9805 2.65994 19.9805 2.39952 19.9805C1.61235 19.7377 1.15012 19.2039 1.0128 18.3789C0.967663 15.5804 0.948131 12.781 0.954206 9.98047C0.948131 7.17996 0.967663 4.38051 1.0128 1.58203C1.15012 0.757074 1.61235 0.22322 2.39952 -0.0195312Z'
							fill='currentColor'
							className='text-primary-600 group-hover:text-bg-01'
						/>
					</g>
					<defs>
						<clipPath id='clip0_139_10961'>
							<rect width='20' height='20' fill='white' />
						</clipPath>
					</defs>
				</svg>
			</button>
		</div>
	);
};

export default PlayVideoBtn;
