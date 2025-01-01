import React from "react";

const LineBetweenItems = () => {
	return (
		<>
			<svg
				className='md:block hidden'
				xmlns='http://www.w3.org/2000/svg'
				width='2'
				height='210'
				viewBox='0 0 2 210'
				fill='none'>
				<path d='M1 1L1.00001 209' stroke='#0F819F' strokeLinecap='round' />
			</svg>
			<svg
				className='md:hidden block'
				xmlns='http://www.w3.org/2000/svg'
				width='210'
				height='2'
				viewBox='0 0 210 2'
				fill='none'>
				<path
					d='M209 1.37988L0.999997 1.37988'
					stroke='#0F819F'
					strokeLinecap='round'
				/>
			</svg>
		</>
	);
};

export default LineBetweenItems;
