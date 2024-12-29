import React from "react";

const AddressTextBox = ({ icon, text }) => {
	return (
		<div className='flex justify-between items-center gap-4'>
			<span>{icon}</span>
			<p className='regular-b1 text-Gray-scale-02 text-right'>{text}</p>
		</div>
	);
};

export default AddressTextBox;
