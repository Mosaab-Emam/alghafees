import React, { forwardRef } from "react";

interface Props {
    name: string;
    label: string;
    placeholder: string;
    radius?: string;
    required?: boolean;
    value?: File | null;
    error?: string;
    handleFileChange: (e: React.ChangeEvent<HTMLInputElement>) => void;
}

const UploadFileInput = forwardRef<HTMLInputElement, Props>(
    (
        {
            required = false,
            name,
            label,
            placeholder,
            radius = "",
            value = null,
            error,
            handleFileChange,
        },
        ref
    ) => {
        return (
            <section className="w-full flex flex-col items-start gap-[20px] self-stretch">
                <div className="flex flex-col items-start gap-[16px] self-stretch group">
                    <label
                        htmlFor={name}
                        className="regular-b1 !text-base text-right text-Gray-scale-02 group-focus-within:text-primary-600 transition-colors duration-300"
                    >
                        {label}
                        {required && <span className="text-red-500">*</span>}
                    </label>
                    <div className="relative w-full">
                        <input
                            ref={ref}
                            type="file"
                            name={name}
                            onChange={handleFileChange}
                            className="absolute inset-0 opacity-0 cursor-pointer z-10"
                        />
                        <div
                            className={`${radius} flex justify-between items-center w-full  sm:h-[48px] lg:h-[46px] xl:h-[48px] px-[16px] py-[13px] bg-bg-02 border-[1px] border-transparent hover:border-primary-400 focus-within:border-primary-600 hover:bg-bg-01 focus-within:bg-bg-01`}
                        >
                            <span
                                className={`regular-b1 !text-base flex-1 px-3 truncate ${
                                    value?.name
                                        ? "text-primary-600"
                                        : "text-Gray-scale-02"
                                }`}
                            >
                                {value?.name || placeholder}
                            </span>

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="#0F819F"
                                className="min-w-[24px]"
                            >
                                <path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM14 13v4h-4v-4H7l5-5 5 5h-3z" />
                            </svg>
                            {error && (
                                <small className="text-red-500 text-xs">
                                    {error}
                                </small>
                            )}
                        </div>
                    </div>
                </div>
            </section>
        );
    }
);

UploadFileInput.displayName = "UploadFileInput";

export default UploadFileInput;
