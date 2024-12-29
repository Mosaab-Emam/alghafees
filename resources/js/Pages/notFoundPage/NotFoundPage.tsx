import React from "react";
import { Button } from "../../components";
import { useNavigate } from "react-router-dom";

function NotFoundPage() {
	const navigate = useNavigate();
	return (
		<div className='fixed inset-0 bg-bg-01 z-50 !overflow-hidden h-full w-full flex items-center justify-center min-h-[60vh] flex-col gap-4'>
			<svg
				width='74px'
				height='74px'
				viewBox='0 0 24 24'
				fill='none'
				xmlns='http://www.w3.org/2000/svg'>
				<g id='SVGRepo_bgCarrier' strokeWidth='0'></g>
				<g
					id='SVGRepo_tracerCarrier'
					strokeLinecap='round'
					strokeLinejoin='round'></g>
				<g id='SVGRepo_iconCarrier'>
					{" "}
					<path
						d='M12 8L12 12'
						stroke='#0F819F'
						strokeWidth='1.5'
						strokeLinecap='round'
						strokeLinejoin='round'></path>{" "}
					<path
						d='M12 16.01L12.01 15.9989'
						stroke='#0F819F'
						strokeWidth='1.5'
						strokeLinecap='round'
						strokeLinejoin='round'></path>{" "}
					<path
						d='M9 3H4V6'
						stroke='#0F819F'
						strokeWidth='1.5'
						strokeLinecap='round'
						strokeLinejoin='round'></path>{" "}
					<path
						d='M4 11V13'
						stroke='#0F819F'
						strokeWidth='1.5'
						strokeLinecap='round'
						strokeLinejoin='round'></path>{" "}
					<path
						d='M20 11V13'
						stroke='#0F819F'
						strokeWidth='1.5'
						strokeLinecap='round'
						strokeLinejoin='round'></path>{" "}
					<path
						d='M15 3H20V6'
						stroke='#0F819F'
						strokeWidth='1.5'
						strokeLinecap='round'
						strokeLinejoin='round'></path>{" "}
					<path
						d='M9 21H4V18'
						stroke='#0F819F'
						strokeWidth='1.5'
						strokeLinecap='round'
						strokeLinejoin='round'></path>{" "}
					<path
						d='M15 21H20V18'
						stroke='#0F819F'
						strokeWidth='1.5'
						strokeLinecap='round'
						strokeLinejoin='round'></path>{" "}
				</g>
			</svg>
			<h1 className=' head-line-h2 text-primary-600'>
				يبدو انك في مكان غير موجود!
			</h1>

			<p className=' head-line-h4 text-Gray-scale-02'>
				الصفحة المطلوبة غير موجودة{" "}
			</p>
			<Button
				className={" px-[80px] py-4 mx-auto"}
				onClick={() => navigate("/")}>
				العودة للصفحة الرئيسية{" "}
			</Button>
		</div>
	);
}

export default NotFoundPage;
