import React, { useState, useEffect } from "react";

const BackToTop = () => {
	const [isVisible, setIsVisible] = useState(false);

	useEffect(() => {
		const toggleVisibility = () => {
			if (window.pageYOffset > 300) {
				setIsVisible(true);
			} else {
				setIsVisible(false);
			}
		};

		window.addEventListener("scroll", toggleVisibility);

		return () => {
			window.removeEventListener("scroll", toggleVisibility);
		};
	}, []);

	const scrollToTop = () => {
		window.scrollTo({
			right: 0,
			behavior: "smooth",
		});
	};

	return (
		<div
			className={`transition duration-700 z-50 ${
				isVisible ? "flex translate-x-0" : " hidden translate-x-[600%]"
			} fixed bottom-4 right-4`}>
			<button
				onClick={scrollToTop}
				className='w-10 h-10 p-2 flex items-center justify-center bg-primary-500 text-white rounded-full shadow-lg hover:bg-primary-600 transition duration-500  '
				aria-label='العودة إلى الأعلى'>
				<svg
					width='64px'
					height='64px'
					viewBox='0 0 24 24'
					fill='none'
					xmlns='http://www.w3.org/2000/svg'
					stroke='#fff'
					className='animate-custom-bounce'>
					<g id='SVGRepo_bgCarrier' strokeWidth='0'></g>
					<g
						id='SVGRepo_tracerCarrier'
						strokeLinecap='round'
						strokeLinejoin='round'></g>
					<g id='SVGRepo_iconCarrier'>
						<path
							fillRule='evenodd'
							clipRule='evenodd'
							d='M12 3C12.2652 3 12.5196 3.10536 12.7071 3.29289L19.7071 10.2929C20.0976 10.6834 20.0976 11.3166 19.7071 11.7071C19.3166 12.0976 18.6834 12.0976 18.2929 11.7071L13 6.41421V20C13 20.5523 12.5523 21 12 21C11.4477 21 11 20.5523 11 20V6.41421L5.70711 11.7071C5.31658 12.0976 4.68342 12.0976 4.29289 11.7071C3.90237 11.3166 3.90237 10.6834 4.29289 10.2929L11.2929 3.29289C11.4804 3.10536 11.7348 3 12 3Z'
							fill='#fff'></path>
					</g>
				</svg>
			</button>
		</div>
	);
};

export default BackToTop;
