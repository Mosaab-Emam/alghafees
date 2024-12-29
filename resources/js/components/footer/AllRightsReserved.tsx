import React from "react";

const AllRightsReserved = () => {
	const date = new Date();
	return (
		<div className='lg:mt-8 xl:mt-[50px] mt-8 lg:mb-8 xl:mb-[74px] mb-8 flex justify-center items-center '>
			<p className='regular-b1 text-Gray-scale-02 '>
				جميع الحقوق محفوظة لدى{" "}
				<span className='text-primary-600 regular-b1'>صالح الغفيص للتقييم</span>{" "}
				العقاري -{date.getFullYear()}
			</p>
		</div>
	);
};

export default AllRightsReserved;
