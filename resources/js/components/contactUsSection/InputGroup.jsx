import React from "react";

const InputGroup = ({ placeholder, type = "text" }) => {
	return (
		<div className='w-full relative flex flex-col items-end gap-4 self-stretch '>
			{type === "text-area" ? (
				<textarea
					placeholder={placeholder}
					className='w-full text-right pb-[48px] resize-none peer hover:text-primary-500 hover:placeholder:text-primary-500 focus:placeholder:text-primary-500 placeholder:text-Gray-scale-02 text-primary-500 text-lg font-normal leading-normal transition duration-700 ease-in-out '
				/>
			) : (
				<input
					placeholder={placeholder}
					className='w-full peer text-right pb-4 hover:text-primary-500 hover:placeholder:text-primary-500 focus:placeholder:text-primary-500 placeholder:text-Gray-scale-02 text-primary-500 text-lg font-normal leading-normal transition duration-700 ease-in-out '
					type={type}
					id='name'
				/>
			)}

			<div className='w-full py-[0.5px] bg-Gray-scale-01 absolute right-0 bottom-0 peer-focus:bg-primary-500 peer-hover:bg-primary-500 transition duration-700 ease-in-out'></div>
		</div>
	);
};

export default InputGroup;
