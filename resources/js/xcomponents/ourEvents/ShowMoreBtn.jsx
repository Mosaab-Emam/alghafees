import React from "react";

const ShowMoreBtn = ({ position = "left-0", onClick }) => {
	return (
		<button
			onClick={onClick}
			className={`w-[60px] h-[60.071px] flex justify-center items-center gap-[10px] flex-shrink-0 p-2 bg-bg-01 opacity-[0.7] rounded-bl-[25px] absolute ${position} group hover:bg-primary-600 hover:opacity-100 transition duration-700 ease-in-out`}>
			<svg
				className='group-hover:text-bg-01'
				xmlns='http://www.w3.org/2000/svg'
				width='42'
				height='42'
				viewBox='0 0 42 42'
				fill='none'>
				<path
					opacity='0.971'
					fillRule='evenodd'
					clipRule='evenodd'
					d='M11.7995 25.4599C11.5124 25.2238 11.3332 24.9252 11.2619 24.5639C11.2619 20.5154 11.2619 16.4668 11.2619 12.4183C11.3946 11.8077 11.7663 11.436 12.3769 11.3033C16.494 11.29 20.6089 11.3033 24.7216 11.3431C25.5739 11.7105 25.8261 12.3212 25.4782 13.1749C25.2721 13.4774 24.9933 13.6765 24.642 13.7722C21.6022 13.7722 18.5626 13.7722 15.5228 13.7722C20.5138 18.7898 25.5047 23.8073 30.4957 28.8248C30.9319 29.6273 30.7461 30.2511 29.9382 30.6964C29.5256 30.8555 29.1406 30.8025 28.7834 30.5371C23.7659 25.5461 18.7484 20.5552 13.7308 15.5642C13.7308 18.5774 13.7308 21.5906 13.7308 24.6037C13.3868 25.5823 12.743 25.8677 11.7995 25.4599Z'
					fill='currentColor'
					className='text-primary-600 group-hover:text-bg-01'
				/>
			</svg>
		</button>
	);
};

export default ShowMoreBtn;
