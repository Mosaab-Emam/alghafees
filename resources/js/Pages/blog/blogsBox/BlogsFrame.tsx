import { Post } from "@/types";
import BlogCard from "./BlogCard";

export default function BlogsFrame({ posts }: { posts: Array<Post> }) {
    return (
        <section className="xl:w-full lg:w-[1200px] w-full flex md:flex-row flex-col md:justify-start justify-center md:content-start content-center md:items-start items-center flex-wrap 2xl:gap-x-8 md:gap-8 gap-y-8 md:mb-[61px] mb-8">
            {posts.map((post, i) => (
                <BlogCard key={post.id} post={post} isLatestTopic={i == 0} />
            ))}
        </section>
    );
}
