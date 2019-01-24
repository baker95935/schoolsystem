#include  <opencv2/highgui/highgui.hpp>
#include  <opencv2/imgproc/imgproc.hpp>
#include  <iostream>
#include  <math.h>
#include  <ctime>
#include  <time.h>
#include  <string>
#include  <vector>
#include <iomanip>
#include <string>
#include <cstdio>

#define WINDOW_NAME1  "image1"
#define WINDOW_NAME2   "image2"
#define WINDOW_NAME3 "image3"
#define WINDOW_NAME4   "image4"
#define WINDOW_NAME5   "image5"


using namespace cv;
using namespace std;

void getoutdot(string& location)
{
	for (decltype(location.size()) index = 0; index != location.size(); ++index)
		location[index] = location[index + 1];

}

void cutside(int x, int y, string address, int kind)
{
	Mat src = cv::imread(address);
//	imshow(WINDOW_NAME1, src);
	double width = src.cols;
	double height = src.rows;
	
//	cout<<width<<endl;	
//	cout<<height<<endl; 
//	cout<<x<<endl;
//	cout<<y<<endl;

	if (x>width)
	{
		x = width;
	}
	if (y>height)
	{
		y = height;
	}
	std::stringstream s;
	std::string str1;



	switch (kind)
	{
	case 1:
	{
			  Mat dst = src(Rect(0, y, width, height-y));
			  imwrite(address, dst);
//			  getoutdot(address);
// 			  time_t nowtime = time(NULL);
// 			  tm *p = localtime(&nowtime);
// 			  std::stringstream ss;
// 			  std::string str;
// 			  ss << p->tm_year + 1900 << p->tm_mon + 1 << p->tm_mday << p->tm_hour << p->tm_min << p->tm_sec << endl;
// 			  ss >> str;
//			  std::stringstream s;
//			  std::string str1;
//			  s << setprecision(3) << x_rotation << "," << setprecision(3) << y_rotation << "," << address << endl;
 //			  s >> str1;
//			  imwrite(str1, dst);
// 			  return str1;
			  break;
	}
	case 2:
	{

			  Mat dst = src(Rect(0, 0, width,y));
			  imwrite(address, dst);
			  //getoutdot(address);
			  //time_t nowtime = time(NULL);
			  //tm *p = localtime(&nowtime);
			  //std::stringstream ss;
			  //std::string str;
			  //ss << p->tm_year + 1900 << p->tm_mon + 1 << p->tm_mday << p->tm_hour << p->tm_min << p->tm_sec << endl;
			  //ss >> str;
			  //std::stringstream s;
			  //std::string str1;
			  //s << setprecision(3) << x_rotation << "," << setprecision(3) << y_rotation << "," << address << endl;
			  //s >> str1;
			  //return str1;
			  break;
	}
	case 3:
	{

			  Mat dst = src(Rect(x, 0, width-x, height));
			  imwrite(address, dst);
			  //getoutdot(address);
			  //time_t nowtime = time(NULL);
			  //tm *p = localtime(&nowtime);
			  //std::stringstream ss;
			  //std::string str;
			  //ss << p->tm_year + 1900 << p->tm_mon + 1 << p->tm_mday << p->tm_hour << p->tm_min << p->tm_sec << endl;
			  //ss >> str;
			  //std::stringstream s;
			  //std::string str1;
			  //s << setprecision(3) << x_rotation << "," << setprecision(3) << y_rotation << "," << address << endl;
			  //s >> str1;
			  //return str1;
			  break;
	}
	case 4:
	{

			  Mat dst = src(Rect(0, 0,x, height));
			  imwrite(address, dst);
			  //getoutdot(address);
			  //time_t nowtime = time(NULL);
			  //tm *p = localtime(&nowtime);
			  //std::stringstream ss;
			  //std::string str;
			  //ss << p->tm_year + 1900 << p->tm_mon + 1 << p->tm_mday << p->tm_hour << p->tm_min << p->tm_sec << endl;
			  //ss >> str;
			  //std::stringstream s;
			  //std::string str1;
			  //s << setprecision(3) << x_rotation << "," << setprecision(3) << y_rotation << "," << address << endl;
			  //s >> str1;
			  //return str1;
			  break;
	}
	};
}

int main ( int argc, char** argv )
//int main(int argc, char** argv)
{
	/*if (argc != 4)
	{
		exit(0);
	}*/

	double   x = atof(argv[1]);
	double   y = atof(argv[2]);
	string  address = argv[3];
	int    kind = atoi(argv[4]);
	cutside(x, y, address, kind);

	//string strmm = cutside( x, y,address, kind);
	//cout << strmm << endl;

	//system("pause");
}
