import React from "react";

const ReqEvluaFormInput = ({
    type,
    placeholder,
    name,
    label,
    value,
    error,
    required = false,
    onChange,
}: {
    type: string;
    placeholder: string;
    name: string;
    label: string;
    value: string;
    error?: string;
    required?: boolean;
    onChange: (e: React.ChangeEvent<HTMLInputElement>) => void;
}) => {
    return (
        <div className="w-full flex flex-col items-start gap-[16px] self-stretch group">
            <label
                htmlFor={name}
                className="regular-b1 text-right text-Gray-scale-02 group-focus-within:text-primary-600 transition-colors duration-300"
            >
                {label} {required && <span className="text-red-500">*</span>}
            </label>
            <input
                id={name}
                type={type}
                name={name}
                value={value}
                onChange={onChange}
                placeholder={placeholder}
                className="w-full text-right max-w-full  sm:h-[48px] lg:h-[46px] xl:h-[48px] flex justify-end items-center rounded-tl-[20px] rounded-br-[20px] py-[13px] px-[16px] gap-[10px] bg-bg-02 border-[1px] border-transparent hover:border-primary-400 focus:border-primary-600 hover:bg-bg-01 focus:bg-bg-01 outline-none transition-all duration-300"
            />
            {error && <small className="text-red-500 text-xs">{error}</small>}
        </div>
    );
};

export default ReqEvluaFormInput;
