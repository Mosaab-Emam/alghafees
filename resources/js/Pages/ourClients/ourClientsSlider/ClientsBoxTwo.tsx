import React from "react";
import { LeftCircleShape, TextContent } from "../../../components";

const ClientsBoxTwo = () => {
	return (
		<section className='md:mt-[175px] mt-[270px] '>
			<div className='md:-mb-[35px] mb-[60px] flex items-center justify-center mx-auto relative '>
				<LeftCircleShape position='md:left-[-100px] -left-10 md:top-[-65px] -top-6' />
				<TextContent width={"w-[243px]"} align='text-center'>
					ثقة <span className='text-primary-600'>عملاؤنا</span> مبنية على
					إنجازات ملموسة
				</TextContent>
			</div>
		</section>
	);
};

export default ClientsBoxTwo;
